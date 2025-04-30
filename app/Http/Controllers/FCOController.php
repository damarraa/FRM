<?php

namespace App\Http\Controllers;

use App\Models\FuseCutOut;
use App\Models\Gudang;
use App\Models\KategoriPabrikan;
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

class FCOController extends Controller
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
        $kategoriNames = ['Fuse Cut Out'];

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

        return view('form.form_fco', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_fco' => 'required|in:Polymer,Keramik',
                'no_serial' => 'required|numeric',
                'tahun_produksi' => 'required|string',
                'masa_pakai' => 'required|string',
                'penandaan_fuse' => 'required|string',
                'keteranganPenandaanFuse' => 'nullable|string|max:55',
                'penandaan_carrier' => 'required|string',
                'keteranganPenandaanCarrier' => 'nullable|string|max:55',
                'fuse_base' => 'required|string',
                'keteranganFuseBase' => 'nullable|string|max:55',
                'fuse_carrier' => 'required|string',
                'keteranganFuseCarrier' => 'nullable|string|max:55',
                'bracket' => 'required|string',
                'keterangan_bracket' => 'nullable|string|max:55',
                'mekanisme_kontak' => 'required|string',
                'keteranganMekanismeKontak' => 'nullable|string|max:55',
                'kondisi_fuse_base' => 'required|string',
                'keteranganKondisiFuseBase' => 'nullable|string|max:55',
                'kondisi_insulator' => 'required|string',
                'keteranganKondisiInsulator' => 'nullable|string|max:55',
                'kondisi_bracket' => 'required|string',
                'keteranganKondisiBracket' => 'nullable|string|max:55',
                'kondisi_fuse_carrier' => 'required|string',
                'keteranganKondisiFuseCarrier' => 'nullable|string|max:55',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
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

            $defaultKeteranganFCO = [
                'keteranganPenandaanFuse' => '',
                'keteranganPenandaanCarrier' => '',
                'keteranganFuseBase' => '',
                'keteranganFuseCarrier' => '',
                'keterangan_bracket' => '',
                'keteranganMekanismeKontak' => 'Posisi kontak antara fuse carrier dengan fuse base',
                'keteranganKondisiFuseBase' => '',
                'keteranganKondisiInsulator' => 'Bebas retak dan rongga (void)',
                'keteranganKondisiBracket' => '',
                'keteranganKondisiFuseCarrier' => 'Terdiri dari tabung pelebur, konektor tabung pelebur, kepala tabung, dan trunion',
                'keterangan_uji_tahanan' => ''
            ];

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
                    $destinationFolder = public_path("gambar_fco");

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

                        $gambarPaths[] = url("gambar_fco/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $fco = FuseCutOut::create([
                'jenis_form_id' => $request->jenis_form_id,
                'no_surat' => $nomorSurat,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tipe_fco' => $request->tipe_fco,
                'no_serial' => $request->no_serial,
                'tahun_produksi' => $request->tahun_produksi,
                'masa_pakai' => $request->masa_pakai,

                'penandaan_fuse' => $request->penandaan_fuse,
                'keteranganPenandaanFuse' => $request->keteranganPenandaanFuse ?: $defaultKeteranganFCO['keteranganPenandaanFuse'],
                'penandaan_carrier' => $request->penandaan_carrier,
                'keteranganPenandaanCarrier' => $request->keteranganPenandaanCarrier ?: $defaultKeteranganFCO['keteranganPenandaanCarrier'],
                'fuse_base' => $request->fuse_base,
                'keteranganFuseBase' => $request->keteranganFuseBase ?: $defaultKeteranganFCO['keteranganFuseBase'],
                'fuse_carrier' => $request->fuse_carrier,
                'keteranganFuseCarrier' => $request->keteranganFuseCarrier ?: $defaultKeteranganFCO['keteranganFuseCarrier'],
                'bracket' => $request->bracket,
                'keterangan_bracket' => $request->keterangan_bracket ?: $defaultKeteranganFCO['keterangan_bracket'],
                'mekanisme_kontak' => $request->mekanisme_kontak,
                'keteranganMekanismeKontak' => $request->keteranganMekanismeKontak ?: $defaultKeteranganFCO['keteranganMekanismeKontak'],
                'kondisi_fuse_base' => $request->kondisi_fuse_base,
                'keteranganKondisiFuseBase' => $request->keteranganKondisiFuseBase ?: $defaultKeteranganFCO['keteranganKondisiFuseBase'],
                'kondisi_insulator' => $request->kondisi_insulator,
                'keteranganKondisiInsulator' => $request->keteranganKondisiInsulator ?: $defaultKeteranganFCO['keteranganKondisiInsulator'],
                'kondisi_bracket' => $request->kondisi_bracket,
                'keteranganKondisiBracket' => $request->keteranganKondisiBracket ?: $defaultKeteranganFCO['keteranganKondisiBracket'],
                'kondisi_fuse_carrier' => $request->kondisi_fuse_carrier,
                'keteranganKondisiFuseCarrier' => $request->keteranganKondisiFuseCarrier ?: $defaultKeteranganFCO['keteranganKondisiFuseCarrier'],

                'uji_tahanan_isolasi' => $request->uji_tahanan_isolasi,
                'keterangan_uji_tahanan' => $request->keterangan_uji_tahanan ?: $defaultKeteranganFCO['keterangan_uji_tahanan'],

                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-fco.create')->with('success', 'Data berhasil disimpan!');
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
        $fco = FuseCutOut::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Fuse Cut Out'];

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

        $selectedUp3Id = $fco->up3_id;
        $selectedUlpId = $fco->ulp_id;
        $selectedPabrikanId = $fco->pabrikan_id;
        $selectedTahunProduksi = $fco->tahun_produksi;
        $selectedGudang = $fco->gudang_id;
        $gambar = json_decode($fco->gambar, true);

        return view('form.form_fco_edit', compact('fco', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'tipe_fco' => 'required|in:Polymer,Keramik',
                'no_serial' => 'required|numeric',
                'penandaan_fuse' => 'required|string',
                'keteranganPenandaanFuse' => 'nullable|string|max:55',
                'penandaan_carrier' => 'required|string',
                'keteranganPenandaanCarrier' => 'nullable|string|max:55',
                'fuse_base' => 'required|string',
                'keteranganFuseBase' => 'nullable|string|max:55',
                'fuse_carrier' => 'required|string',
                'keteranganFuseCarrier' => 'nullable|string|max:55',
                'bracket' => 'required|string',
                'keterangan_bracket' => 'nullable|string|max:55',
                'mekanisme_kontak' => 'required|string',
                'keteranganMekanismeKontak' => 'nullable|string|max:55',
                'kondisi_fuse_base' => 'required|string',
                'keteranganKondisiFuseBase' => 'nullable|string|max:55',
                'kondisi_insulator' => 'required|string',
                'keteranganKondisiInsulator' => 'nullable|string|max:55',
                'kondisi_bracket' => 'required|string',
                'keteranganKondisiBracket' => 'nullable|string|max:55',
                'kondisi_fuse_carrier' => 'required|string',
                'keteranganKondisiFuseCarrier' => 'nullable|string|max:80',
                'uji_tahanan_isolasi' => 'nullable|numeric',
                'keterangan_uji_tahanan' => 'nullable|string|max:55',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
                'status' => 'sometimes|string', // Tambahkan validasi untuk status
            ]);

            $defaultKeteranganFCO = [
                'keteranganPenandaanFuse' => '',
                'keteranganPenandaanCarrier' => '',
                'keteranganFuseBase' => '',
                'keteranganFuseCarrier' => '',
                'keterangan_bracket' => '',
                'keteranganMekanismeKontak' => 'Posisi kontak antara fuse carrier dengan fuse base',
                'keteranganKondisiFuseBase' => '',
                'keteranganKondisiInsulator' => 'Bebas retak dan rongga (void)',
                'keteranganKondisiBracket' => '',
                'keteranganKondisiFuseCarrier' => 'Terdiri dari tabung pelebur, konektor tabung pelebur, kepala tabung, dan trunion',
                'keterangan_uji_tahanan' => ''
            ];

            // Find the record or fail with 404
            $fco = FuseCutOut::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $fco->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($fco->gambar) {
                    foreach (json_decode($fco->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_fco");

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

                    $gambarPaths[] = url("gambar_fco/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganFCO as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $fco->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $fco->status = 'Approved';
                $fco->approved_by = Auth::id();
            }

            // Cek perubahan data yang sebenarnya (selain status dan approved_by)
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
                $fco->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $fco->updated_at = $oldData['updated_at'];
            }

            $fco->save();

            // Log success
            Log::info('FCO updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during FCO update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating FCO', [
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
        $fco = FuseCutOut::findOrFail($id);
        $fco->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
