<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\PHBTR;
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

class PHBTRController extends Controller
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
        $kategoriNames = ['PHBTR'];

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

        return view('form.form_phbtr', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_phbtr' => 'required|in:PL-250-2-LBS,PL-250-2-MCCB,PL-250-2-FS,PL-400-2-LBS,PL-400-2-MCCB,PL-400-2-FS,PL-400-4-LBS,PL-400-4-MCCB,PL-400-4-FS,PL-4-LBS,PL-4-MCCB,PL-4-FS,PL-100-6-LBS,PL-100-6-MCCB,PL-100-8-LBS,PL-100-8-MCCB',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'busbar_penyangga' => 'required|string',
                'saklar_utama' => 'required|string',
                'nh_fuse' => 'required|string',
                'fuse_rail' => 'required|string',
                'selungkup_phbtr' => 'required|string',
                'l1_phbtr' => 'nullable|string',
                'l2_phbtr' => 'nullable|string',
                'l3_phbtr' => 'nullable|string',
                'nphbtr' => 'nullable|string',
                'pengujian_mekanik1' => 'required|string',
                'pengujian_mekanik2' => 'required|string',
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

            $defaultKeteranganPHBTR = [
                'keteranganNameplate' => ' ',
                'keteranganBusbar' => ' ',
                'keteranganSaklarUtama' => ' ',
                'keteranganNHFuse' => ' ',
                'keteranganFuseRail' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganL1PHBTR' => ' ',
                'keteranganL2PHBTR' => ' ',
                'keteranganL3PHBTR' => ' ',
                'keteranganNPHBTR' => ' ',
                'keteranganMekanik1' => ' ',
                'keteranganMekanik2' => ' ',
            ];

            $persyaratan_nameplate = 'Ada';
            $persyaratan_busbar_penyangga = 'Ada';
            $persyaratan_saklar_utama = 'Ada';
            $persyaratan_nh_fuse = 'Ada';
            $persyaratan_fuse_rail = 'Ada';
            $persyaratan_selungkup_phbtr = 'Tidak ada';

            $persyaratan_pengujian_mekanik1 = 'Saklar tetap beroperasi dengan baik';
            $persyaratan_pengujian_mekanik2 = 'Pintu tetap beroperasi dengan baik';

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
                    $destinationFolder = public_path("gambar_phbtr");

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

                        $gambarPaths[] = url("gambar_phbtr/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $phbtr = PHBTR::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_phbtr' => $request->tipe_phbtr,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'nameplate' => $request->nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'keteranganNameplate' => $request->keteranganNameplate ?: $defaultKeteranganPHBTR['keteranganNameplate'],
                'busbar_penyangga' => $request->busbar_penyangga,
                'persyaratan_busbar_penyangga' => $persyaratan_busbar_penyangga,
                'keteranganBusbar' => $request->keteranganBusbar ?: $defaultKeteranganPHBTR['keteranganBusbar'],
                'saklar_utama' => $request->saklar_utama,
                'persyaratan_saklar_utama' => $persyaratan_saklar_utama,
                'keteranganSaklarUtama' => $request->keteranganSaklarUtama ?: $defaultKeteranganPHBTR['keteranganSaklarUtama'],
                'nh_fuse' => $request->nh_fuse,
                'persyaratan_nh_fuse' => $persyaratan_nh_fuse,
                'keteranganNHFuse' => $request->keteranganNHFuse ?: $defaultKeteranganPHBTR['keteranganNHFuse'],
                'fuse_rail' => $request->fuse_rail,
                'persyaratan_fuse_rail' => $persyaratan_fuse_rail,
                'keteranganFuseRail' => $request->keteranganFuseRail ?: $defaultKeteranganPHBTR['keteranganFuseRail'],
                'selungkup_phbtr' => $request->selungkup_phbtr,
                'persyaratan_selungkup_phbtr' => $persyaratan_selungkup_phbtr,
                'keteranganSelungkup' => $request->keteranganSelungkup ?: $defaultKeteranganPHBTR['keteranganSelungkup'],
                'l1_phbtr' => $request->l1_phbtr,
                'keteranganL1PHBTR' => $request->keteranganL1PHBTR ?: $defaultKeteranganPHBTR['keteranganL1PHBTR'],
                'l2_phbtr' => $request->l2_phbtr,
                'keteranganL2PHBTR' => $request->keteranganL2PHBTR ?: $defaultKeteranganPHBTR['keteranganL2PHBTR'],
                'l3_phbtr' => $request->l3_phbtr,
                'keteranganL3PHBTR' => $request->keteranganL3PHBTR ?: $defaultKeteranganPHBTR['keteranganL3PHBTR'],
                'nphbtr' => $request->nphbtr,
                'keteranganNPHBTR' => $request->keteranganNPHBTR ?: $defaultKeteranganPHBTR['keteranganNPHBTR'],
                'pengujian_mekanik1' => $request->pengujian_mekanik1,
                'persyaratan_pengujian_mekanik1' => $persyaratan_pengujian_mekanik1,
                'keteranganMekanik1' => $request->keteranganMekanik1 ?: $defaultKeteranganPHBTR['keteranganMekanik1'],
                'pengujian_mekanik2' => $request->pengujian_mekanik2,
                'persyaratan_pengujian_mekanik2' => $persyaratan_pengujian_mekanik2,
                'keteranganMekanik2' => $request->keteranganMekanik2 ?: $defaultKeteranganPHBTR['keteranganMekanik2'],
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-phbtr.create')->with('success', 'Data berhasil disimpan!');
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
        $phbtr = PHBTR::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['PHBTR'];

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

        $selectedUp3Id = $phbtr->up3_id;
        $selectedUlpId = $phbtr->ulp_id;
        $selectedPabrikanId = $phbtr->pabrikan_id;
        $selectedTahunProduksi = $phbtr->tahun_produksi;
        $selectedGudang = $phbtr->gudang_id;
        $gambar = json_decode($phbtr->gambar, true);

        return view('form.form_phbtr_edit', compact('phbtr', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'tipe_phbtr' => 'required|in:PL-250-2-LBS,PL-250-2-MCCB,PL-250-2-FS,PL-400-2-LBS,PL-400-2-MCCB,PL-400-2-FS,PL-400-4-LBS,PL-400-4-MCCB,PL-400-4-FS,PL-4-LBS,PL-4-MCCB,PL-4-FS,PL-100-6-LBS,PL-100-6-MCCB,PL-100-8-LBS,PL-100-8-MCCB',
                'tahun_produksi' => 'required|string',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'keteranganNameplate' => 'nullable|string|max:55',
                'busbar_penyangga' => 'required|string',
                'keteranganBusbar' => 'nullable|string|max:55',
                'saklar_utama' => 'required|string',
                'keteranganSaklarUtama' => 'nullable|string|max:55',
                'nh_fuse' => 'required|string',
                'keteranganNHFuse' => 'nullable|string|max:55',
                'fuse_rail' => 'required|string',
                'keteranganFuseRail' => 'nullable|string|max:55',
                'selungkup_phbtr' => 'required|string',
                'keteranganSelungkup' => 'nullable|string|max:55',
                'l1_phbtr' => 'nullable|string',
                'keteranganL1PHBTR' => 'nullable|string|max:55',
                'l2_phbtr' => 'nullable|string',
                'keteranganL2PHBTR' => 'nullable|string|max:55',
                'l3_phbtr' => 'nullable|string',
                'keteranganL3PHBTR' => 'nullable|string|max:55',
                'nphbtr' => 'nullable|string',
                'keteranganNPHBTR' => 'nullable|string|max:55',
                'pengujian_mekanik1' => 'required|string',
                'keteranganMekanik1' => 'nullable|string|max:55',
                'pengujian_mekanik2' => 'required|string',
                'keteranganMekanik2' => 'nullable|string|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            $defaultKeteranganPHBTR = [
                'keteranganNameplate' => ' ',
                'keteranganBusbar' => ' ',
                'keteranganSaklarUtama' => ' ',
                'keteranganNHFuse' => ' ',
                'keteranganFuseRail' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganL1PHBTR' => ' ',
                'keteranganL2PHBTR' => ' ',
                'keteranganL3PHBTR' => ' ',
                'keteranganNPHBTR' => ' ',
                'keteranganMekanik1' => ' ',
                'keteranganMekanik2' => ' ',
            ];

            // Find the record or fail with 404
            $phbtr = PHBTR::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $phbtr->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($phbtr->gambar) {
                    foreach (json_decode($phbtr->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_phbtr");

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

                    $gambarPaths[] = url("gambar_phbtr/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganPHBTR as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $phbtr->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $phbtr->status = 'Approved';
                $phbtr->approved_by = Auth::id();
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
                $phbtr->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $phbtr->updated_at = $oldData['updated_at'];
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

            $phbtr->save();

            // Log success
            Log::info('PHBTR updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during PHBTR update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating PHBTR', [
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
        $phbtr = PHBTR::findOrFail($id);
        $phbtr->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
