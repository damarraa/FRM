<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\LBS;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Str;

class LBSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Load Break Switch'];

        // Ambil kategori berdasarkan nama
        $kategoriPabrikans = KategoriPabrikan::whereIn('nama_kategori', $kategoriNames)->get();

        // Ambil ID kategori yang ditemukan
        $kategoriIds = $kategoriPabrikans->pluck('id');

        // Ambil semua Pabrikan yang memiliki salah satu dari kategori tersebut
        $pabrikans = Pabrikan::whereHas('kategoriPabrikans', function ($query) use ($kategoriIds) {
            $query->whereIn('kategori_id', $kategoriIds); // Perbaiki dari 'kategori_pabrikan_id' ke 'kategori_id'
        })->get();

        // List UID
        $uids = UID::all();

        // List UP3
        $up3s = UP3::all();

        // List ULP
        $ulps = ULP::all();

        // List Gudang
        $gudangs = Gudang::all();

        return view('form.form_lbs', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tgl_inspeksi' => 'required|date',
                'lokasi_akhir_terpasang' => 'required|string',
                'tipe_lbs' => 'required|in:Vacuum,SF6',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'penandaan_terminal' => 'required|string',
                'counter_lbs' => 'required|string',
                'bushing_lbs' => 'required|string',
                'indikator_lbs' => 'required|string',
                'rtu_lbs' => 'required|string',
                'interuptor_lbs' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $up3 = UP3::where('id', $request->up3_id)->where('uid_id', $request->uid_id)->first();
            $ulp = ULP::where('id', $request->ulp_id)->where('up3_id', $request->up3_id)->first();

            if (!$up3 || !$ulp) {
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!']);
            }

            $defaultKeteranganPengujianMekanik = [
                'keteranganMekanikManual' => ' ',
                'keteranganPanelKontrol' => ' '
            ];

            $persyaratan_nameplate = 'Ada';
            $persyaratan_penandaan_terminal = 'Ada';
            $persyaratan_counter_lbs = 'Ada';
            $persyaratan_bushing_lbs = 'Tidak ada';
            $persyaratan_indikator_lbs = 'Ada';
            $persyaratan_rtu_lbs = 'Ada';
            $persyaratan_interuptor_lbs = 'Tidak ada';

            $persyaratan_mekanik1_lbs = 'Berhasil';
            $persyaratan_mekanik2_lbs = 'Berhasil';

            // Hitung persentase perbedaan tahanan dengan error handling
            try {
                $dR = (float)$request->elektrik_r;
                $dS = (float)$request->elektrik_s;
                $dT = (float)$request->elektrik_t;

                $perbedaanRS = abs($dR - $dS);
                $perbedaanRT = abs($dR - $dT);
                $perbedaanST = abs($dS - $dT);

                $persentaseRS = $dR != 0 ? ($perbedaanRS / $dR) * 100 : 0;
                $persentaseRT = $dR != 0 ? ($perbedaanRT / $dR) * 100 : 0;
                $persentaseST = $dS != 0 ? ($perbedaanST / $dS) * 100 : 0;

                $kesesuaianElektrik = ($persentaseRS <= 20) &&
                    ($persentaseRT <= 20) &&
                    ($persentaseST <= 20);

                $dataElektrik = [
                    'perbedaan' => compact('perbedaanRS', 'perbedaanRT', 'perbedaanST'),
                    'persentase' => compact('persentaseRS', 'persentaseRT', 'persentaseST'),
                    'kesesuaian' => $kesesuaianElektrik,
                    'terakhir_diupdate' => now()->toDateTimeString()
                ];
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal menghitung persentase perbedaan tahanan: ' . $e->getMessage());
            }

            $nomorSurat = NomorSurat::generateNomorSurat(
                $request->jenis_form_id,
                $request->up3_id,
                $request->gudang_id,
                $request->tgl_inspeksi
            );

            $gambarPaths = [];

            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $filename = Str::random(20) . '.jpg';
                    $destinationFolder = public_path("gambar_lbs");

                    // Cek apakah folder ada, jika tidak buat foldernya
                    if (!File::exists($destinationFolder)) {
                        File::makeDirectory($destinationFolder, 0777, true, true);
                    }

                    $destinationPath = "{$destinationFolder}/{$filename}";

                    $imageType = $file->getClientOriginalExtension();
                    $image = null;

                    switch ($imageType) {
                        case 'jpg':
                        case 'jpeg':
                            $image = imagecreatefromjpeg($file->getRealPath());
                            break;
                        case 'png':
                            $image = imagecreatefrompng($file->getRealPath());
                            break;
                        case 'webp':
                            $image = imagecreatefromwebp($file->getRealPath());
                            break;
                        default:
                            return response()->json(['error' => 'Format gambar tidak didukung'], 400);
                    }

                    if ($image) {
                        $width = imagesx($image);
                        $height = imagesy($image);
                        $newWidth = 1080;
                        $newHeight = ($newWidth / $width) * $height;

                        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($resizedImage, $destinationPath, 60); // Simpan ke public/gambar_kwh

                        imagedestroy($image);
                        imagedestroy($resizedImage);

                        $gambarPaths[] = url("gambar_lbs/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $lbs = LBS::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_lbs' => $request->tipe_lbs,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'nameplate' => $request->nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'penandaan_terminal' => $request->penandaan_terminal,
                'persyaratan_penandaan_terminal' => $persyaratan_penandaan_terminal,
                'counter_lbs' => $request->counter_lbs,
                'persyaratan_counter_lbs' => $persyaratan_counter_lbs,
                'bushing_lbs' => $request->bushing_lbs,
                'persyaratan_bushing_lbs' => $persyaratan_bushing_lbs,
                'indikator_lbs' => $request->indikator_lbs,
                'persyaratan_indikator_lbs' => $persyaratan_indikator_lbs,
                'rtu_lbs' => $request->rtu_lbs,
                'persyaratan_rtu_lbs' => $persyaratan_rtu_lbs,
                'interuptor_lbs' => $request->interuptor_lbs,
                'persyaratan_interuptor_lbs' => $persyaratan_interuptor_lbs,
                'mekanik1_lbs' => $request->mekanik1_lbs,
                'persyaratan_mekanik1_lbs' => $persyaratan_mekanik1_lbs,
                'keteranganMekanikManual' => $request->keteranganMekanikManual ?: $defaultKeteranganPengujianMekanik['keteranganMekanikManual'],
                'mekanik2_lbs' => $request->mekanik2_lbs,
                'persyaratan_mekanik2_lbs' => $persyaratan_mekanik2_lbs,
                'keteranganPanelKontrol' => $request->keteranganPanelKontrol ?: $defaultKeteranganPengujianMekanik['keteranganPanelKontrol'],
                'elektrik_r' => $dR,
                'elektrik_s' => $dS,
                'elektrik_t' => $dT,
                'kesesuaian_elektrik' => $kesesuaianElektrik, // Ganti $kesesuaianOverall dengan $kesesuaianElektrik
                'data_elektrik' => json_encode($dataElektrik),
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-lbs.create')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get data by Id
        $lbs = LBS::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Load Break Switch'];

        // Ambil kategori berdasarkan nama
        $kategoriPabrikans = KategoriPabrikan::whereIn('nama_kategori', $kategoriNames)->get();

        // Ambil ID kategori yang ditemukan
        $kategoriIds = $kategoriPabrikans->pluck('id');

        // Ambil semua Pabrikan yang memiliki salah satu dari kategori tersebut
        $pabrikans = Pabrikan::whereHas('kategoriPabrikans', function ($query) use ($kategoriIds) {
            $query->whereIn('kategori_id', $kategoriIds); // Perbaiki dari 'kategori_pabrikan_id' ke 'kategori_id'
        })->get();

        // List UID
        $uids = UID::all();

        // List UP3
        $up3s = UP3::all();

        // List ULP
        $ulps = ULP::all();

        // List Gudang
        $gudangs = Gudang::all();

        $selectedUp3Id = $lbs->up3_id;
        $selectedUlpId = $lbs->ulp_id;
        $selectedPabrikanId = $lbs->pabrikan_id;
        $selectedTahunProduksi = $lbs->tahun_produksi;
        $selectedGudang = $lbs->gudang_id;
        $gambar = json_decode($lbs->gambar, true);

        return view('form.form_lbs_edit', compact('lbs', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'lokasi_akhir_terpasang' => 'required|string',
                'tipe_lbs' => 'required|in:Vacuum,SF6',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'penandaan_terminal' => 'required|string',
                'counter_lbs' => 'required|string',
                'bushing_lbs' => 'required|string',
                'indikator_lbs' => 'required|string',
                'rtu_lbs' => 'required|string',
                'interuptor_lbs' => 'required|string',
                'mekanik1_lbs' => 'nullable|string',
                'keteranganMekanikManual' => 'nullable|string|max:55',
                'mekanik2_lbs' => 'nullable|string',
                'keteranganPanelKontrol' => 'nullable|string|max:55',
                'elektrik_r' => 'nullable|numeric',
                'elektrik_s' => 'nullable|numeric',
                'elektrik_t' => 'nullable|numeric',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            $defaultKeteranganPengujianMekanik = [
                'keteranganMekanikManual' => ' ',
                'keteranganPanelKontrol' => ' '
            ];

            // Find the record or fail with 404
            $lbs = LBS::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $lbs->getOriginal();

            // Hitung kesesuaian elektrik jika nilai elektrik diubah
            if ($request->hasAny(['elektrik_r', 'elektrik_s', 'elektrik_t'])) {
                try {
                    $dR = (float)$request->elektrik_r;
                    $dS = (float)$request->elektrik_s;
                    $dT = (float)$request->elektrik_t;

                    $perbedaanRS = abs($dR - $dS);
                    $perbedaanRT = abs($dR - $dT);
                    $perbedaanST = abs($dS - $dT);

                    $persentaseRS = $dR != 0 ? ($perbedaanRS / $dR) * 100 : 0;
                    $persentaseRT = $dR != 0 ? ($perbedaanRT / $dR) * 100 : 0;
                    $persentaseST = $dS != 0 ? ($perbedaanST / $dS) * 100 : 0;

                    $kesesuaianElektrik = ($persentaseRS <= 20) &&
                        ($persentaseRT <= 20) &&
                        ($persentaseST <= 20);

                    $dataElektrik = [
                        'perbedaan' => compact('perbedaanRS', 'perbedaanRT', 'perbedaanST'),
                        'persentase' => compact('persentaseRS', 'persentaseRT', 'persentaseST'),
                        'kesesuaian' => $kesesuaianElektrik,
                        'terakhir_diupdate' => now()->toDateTimeString()
                    ];

                    $validated['kesesuaian_elektrik'] = $kesesuaianElektrik;
                    $validated['data_elektrik'] = json_encode($dataElektrik);
                } catch (\Exception $e) {
                    return back()->with('error', 'Gagal menghitung persentase perbedaan tahanan: ' . $e->getMessage());
                }
            }

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($lbs->gambar) {
                    foreach (json_decode($lbs->gambar) as $oldImage) {
                        $oldImagePath = public_path(parse_url($oldImage, PHP_URL_PATH));
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                }

                // Simpan gambar baru
                $gambarPaths = [];
                foreach ($request->file('gambar') as $file) {
                    $filename = Str::random(20) . '.jpg';
                    $destinationFolder = public_path("gambar_lbs");

                    // Buat folder jika belum ada
                    if (!File::exists($destinationFolder)) {
                        File::makeDirectory($destinationFolder, 0777, true, true);
                    }

                    $destinationPath = "{$destinationFolder}/{$filename}";
                    $imageType = $file->getClientOriginalExtension();
                    $image = match ($imageType) {
                        'jpg', 'jpeg' => imagecreatefromjpeg($file->getRealPath()),
                        'png' => imagecreatefrompng($file->getRealPath()),
                        'webp' => imagecreatefromwebp($file->getRealPath()),
                        default => null,
                    };

                    if (!$image) {
                        return response()->json(['error' => 'Format gambar tidak didukung'], 400);
                    }

                    $width = imagesx($image);
                    $height = imagesy($image);
                    $newWidth = 1080;
                    $newHeight = ($newWidth / $width) * $height;

                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($resizedImage, $destinationPath, 60);

                    imagedestroy($image);
                    imagedestroy($resizedImage);

                    $gambarPaths[] = url("gambar_lbs/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganPengujianMekanik as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $lbs->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $lbs->status = 'Approved';
                $lbs->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();

            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $lbs->status = 'Approved';
            //     $lbs->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
            // }

            $isDataChanged = false;
            $changedFields = [];
            foreach ($validated as $key => $value) {
                if (!in_array($key, ['status', 'approved_by']) && $oldData[$key] != $value) {
                    $isDataChanged = true;
                    $changedFields[] = $key;
                    break;
                }
            }

            // Logika timestamp
            if ($isDataChanged) {
                // Jika ada perubahan data: update updated_at
                $lbs->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $lbs->updated_at = $oldData['updated_at'];
            }

            // Cek apakah ada perubahan pada kolom selain status
            // $isEdited = false;
            // foreach ($validated as $key => $value) {
            //     if ($key !== 'status' && $oldData[$key] != $value) {
            //         $isEdited = true;
            //         break;
            //     }
            // }

            // Jika ada perubahan pada kolom selain status, update updated_at
            // if ($isEdited) {
            //     $lbs->updated_at = now(); // Update timestamp perubahan
            // }

            // Jika hanya status yang diubah, jangan update updated_at
            // if (!$isEdited && $request->has('status')) {
            //     $lbs->timestamps = false; // Nonaktifkan timestamp otomatis
            // }

            $lbs->save();

            // Log success
            Log::info('LBS updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during LBS update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating LBS', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with generic error
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lbs = LBS::findOrFail($id);
        $lbs->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
