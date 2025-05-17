<?php

namespace App\Http\Controllers;

use App\Models\Cubicle;
use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CubicleController extends Controller
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
        $kategoriNames = ['Cubicle'];

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

        return view('form.form_cubicle', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_cubicle' => 'required|in:LBS-Motorized,TP,VT,LBS-Manual,CB',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'kelengkapan_peralatan' => 'required|string',
                'busbar_penyangga' => 'required|string',
                'kondisi_pembumian' => 'required|string',
                'kondisi_selungkup' => 'required|string',
                'l1_cubicle' => 'nullable|string',
                'l2_cubicle' => 'nullable|string',
                'l3_cubicle' => 'nullable|string',
                'n_cubicle' => 'nullable|string',
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

            $defaultKeteranganCubicle = [
                'keteranganNameplate' => ' ',
                'keteranganKelengkapan' => ' ',
                'keteranganBusbar' => ' ',
                'keteranganPembumian' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganL1Cubicle' => ' ',
                'keteranganL2Cubicle' => ' ',
                'keteranganL3Cubicle' => ' ',
                'keteranganNCubicle' => ' ',
                'keteranganPengujianMekanik1' => ' ',
                'keteranganPengujianMekanik2' => ' ',
            ];

            $persyaratan_nameplate = 'Ada';
            $persyaratan_kelengkapan_peralatan = 'Ada';
            $persyaratan_busbar_penyangga = 'Ada';
            $persyaratan_kondisi_pembumian = 'Ada';
            $persyaratan_kondisi_selungkup = 'Tidak ada';

            $persyaratan_pengujian_mekanik1 = 'Baik';
            $persyaratan_pengujian_mekanik2 = 'Baik';

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
                    $destinationFolder = public_path("gambar_cubicle");

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

                        $gambarPaths[] = url("gambar_cubicle/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $cubicle = Cubicle::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_cubicle' => $request->tipe_cubicle,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'nameplate' => $request->nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'keteranganNameplate' => $request->keteranganNameplate ?: $defaultKeteranganCubicle['keteranganNameplate'],
                'kelengkapan_peralatan' => $request->kelengkapan_peralatan,
                'persyaratan_kelengkapan_peralatan' => $persyaratan_kelengkapan_peralatan,
                'keteranganKelengkapan' => $request->keteranganKelengkapan ?: $defaultKeteranganCubicle['keteranganKelengkapan'],
                'busbar_penyangga' => $request->busbar_penyangga,
                'persyaratan_busbar_penyangga' => $persyaratan_busbar_penyangga,
                'keteranganBusbar' => $request->keteranganBusbar ?: $defaultKeteranganCubicle['keteranganBusbar'],
                'kondisi_pembumian' => $request->kondisi_pembumian,
                'persyaratan_kondisi_pembumian' => $persyaratan_kondisi_pembumian,
                'keteranganPembumian' => $request->keteranganPembumian ?: $defaultKeteranganCubicle['keteranganPembumian'],
                'kondisi_selungkup' => $request->kondisi_selungkup,
                'persyaratan_kondisi_selungkup' => $persyaratan_kondisi_selungkup,
                'keteranganSelungkup' => $request->keteranganSelungkup ?: $defaultKeteranganCubicle['keteranganSelungkup'],
                'l1_cubicle' => $request->l1_cubicle,
                'keteranganL1Cubicle' => $request->keteranganL1Cubicle ?: $defaultKeteranganCubicle['keteranganL1Cubicle'],
                'l2_cubicle' => $request->l2_cubicle,
                'keteranganL2Cubicle' => $request->keteranganL2Cubicle ?: $defaultKeteranganCubicle['keteranganL2Cubicle'],
                'l3_cubicle' => $request->l3_cubicle,
                'keteranganL3Cubicle' => $request->keteranganL3Cubicle ?: $defaultKeteranganCubicle['keteranganL3Cubicle'],
                'n_cubicle' => $request->n_cubicle,
                'keteranganNCubicle' => $request->keteranganNCubicle ?: $defaultKeteranganCubicle['keteranganNCubicle'],
                'pengujian_mekanik1' => $request->pengujian_mekanik1,
                'persyaratan_pengujian_mekanik1' => $persyaratan_pengujian_mekanik1,
                'keteranganPengujianMekanik1' => $request->keteranganPengujianMekanik1 ?: $defaultKeteranganCubicle['keteranganPengujianMekanik1'],
                'pengujian_mekanik2' => $request->pengujian_mekanik2,
                'persyaratan_pengujian_mekanik2' => $persyaratan_pengujian_mekanik2,
                'keteranganPengujianMekanik2' => $request->keteranganPengujianMekanik2 ?: $defaultKeteranganCubicle['keteranganPengujianMekanik2'],
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-cubicle.create')->with('success', 'Data berhasil disimpan!');
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
    // public function edit(string $id)
    // {
    //     // Get data by Id
    //     $cubicle = Cubicle::findOrFail($id);

    //     // Definisikan kategori yang ingin dicari
    //     $kategoriNames = ['Cubicle'];

    //     // Ambil kategori berdasarkan nama
    //     $kategoriPabrikans = KategoriPabrikan::whereIn('nama_kategori', $kategoriNames)->get();

    //     // Ambil ID kategori yang ditemukan
    //     $kategoriIds = $kategoriPabrikans->pluck('id');

    //     // Ambil semua Pabrikan yang memiliki salah satu dari kategori tersebut
    //     $pabrikans = Pabrikan::whereHas('kategoriPabrikans', function ($query) use ($kategoriIds) {
    //         $query->whereIn('kategori_id', $kategoriIds); // Perbaiki dari 'kategori_pabrikan_id' ke 'kategori_id'
    //     })->get();

    //     // List UID
    //     $uids = UID::all();

    //     // List UP3
    //     $up3s = UP3::all();

    //     // List ULP
    //     $ulps = ULP::all();

    //     // List Gudang
    //     $gudangs = Gudang::all();

    //     $selectedUp3Id = $cubicle->up3_id;
    //     $selectedUlpId = $cubicle->ulp_id;
    //     $selectedPabrikanId = $cubicle->pabrikan_id;
    //     $selectedTahunProduksi = $cubicle->tahun_produksi;
    //     $selectedGudang = $cubicle->gudang_id;
    //     $gambar = json_decode($cubicle->gambar, true);

    //     return view('form.form_cubicle_edit', compact('cubicle', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
    // }
    public function edit(string $id)
    {
        // Get data by Id
        $cubicle = Cubicle::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Cubicle'];

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

        $selectedUp3Id = $cubicle->up3_id;
        $selectedUlpId = $cubicle->ulp_id;
        $selectedPabrikanId = $cubicle->pabrikan_id;
        $selectedTahunProduksi = $cubicle->tahun_produksi;
        $selectedGudang = $cubicle->gudang_id;
        $gambar = json_decode($cubicle->gambar, true);

        return view('form.form_cubicle_edit', compact('cubicle', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'tipe_cubicle' => 'required|in:LBS-Motorized,TP,VT,LBS-Manual,CB',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'keteranganNameplate' => 'nullable|string|max:55',
                'kelengkapan_peralatan' => 'required|string',
                'keteranganKelengkapan' => 'nullable|string|max:55',
                'busbar_penyangga' => 'required|string',
                'keteranganBusbar' => 'nullable|string|max:55',
                'kondisi_pembumian' => 'required|string',
                'keteranganPembumian' => 'nullable|string|max:55',
                'kondisi_selungkup' => 'required|string',
                'keteranganSelungkup' => 'nullable|string|max:55',
                'l1_cubicle' => 'nullable|string',
                'keteranganL1Cubicle' => 'nullable|string|max:55',
                'l2_cubicle' => 'nullable|string',
                'keteranganL2Cubicle' => 'nullable|string|max:55',
                'l3_cubicle' => 'nullable|string',
                'keteranganL3Cubicle' => 'nullable|string|max:55',
                'n_cubicle' => 'nullable|string',
                'keteranganNCubicle' => 'nullable|string|max:55',
                'pengujian_mekanik1' => 'required|string',
                'keteranganPengujianMekanik1' => 'nullable|string|max:55',
                'pengujian_mekanik2' => 'required|string',
                'keteranganPengujianMekanik2' => 'nullable|string|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            $defaultKeteranganCubicle = [
                'keteranganNameplate' => ' ',
                'keteranganKelengkapan' => ' ',
                'keteranganBusbar' => ' ',
                'keteranganPembumian' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganL1Cubicle' => ' ',
                'keteranganL2Cubicle' => ' ',
                'keteranganL3Cubicle' => ' ',
                'keteranganNCubicle' => ' ',
                'keteranganPengujianMekanik1' => ' ',
                'keteranganPengujianMekanik2' => ' ',
            ];

            // Find the record or fail with 404
            $cubicle = Cubicle::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $cubicle->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($cubicle->gambar) {
                    foreach (json_decode($cubicle->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_cubicle");

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

                    $gambarPaths[] = url("gambar_cubicle/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganCubicle as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $cubicle->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $cubicle->status = 'Approved';
                $cubicle->approved_by = Auth::id();
            }

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
                $cubicle->is_edited = true;
                // Jika ada perubahan data: update updated_at
                $cubicle->updated_at = now();
            } elseif ($isApproving) {
                $cubicle->is_edited = false;
                // Jika hanya approval: jangan update updated_at
                $cubicle->updated_at = $oldData['updated_at'];
            }

            $cubicle->save();

            // Log success
            Log::info('Cubicle updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Cubicle update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Cubicle', [
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
        $cubicle = Cubicle::findOrFail($id);
        $cubicle->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
