<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Isolator;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IsolatorController extends Controller
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
        $kategoriNames = ['Isolator'];

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

        return view('form.form_isolator', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_isolator' => 'required|in:Pin,Pin Post,Line Post,Suspension',
                'no_serial' => 'required|numeric',
                'kondisi_visual' => 'required|string',
                'keteranganVisualTampak' => 'nullable|string|max:55',
                'kondisi_warna' => 'required|string',
                'keteranganKondisiWarna' => 'nullable|string|max:55',
                'kondisi_pecah' => 'required|string',
                'keteranganKondisiPecah' => 'nullable|string|max:55',
                'kondisi_permukaan' => 'required|string',
                'keteranganKondisiPermukaan' => 'nullable|string|max:55',
                'kondisi_korosi' => 'required|string',
                'keteranganKondisiKorosi' => 'nullable|string|max:55',
                'pengujian_isolasi' => 'nullable|string',
                'keteranganTahananIsolasi' => 'nullable|string|max:55',
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

            $defaultKeteranganIsolator = [
                'keteranganVisualTampak' => '',
                'keteranganKondisiWarna' => '',
                'keteranganKondisiPecah' => '',
                'keteranganKondisiPermukaan' => '',
                'keteranganKondisiKorosi' => '',
                'keteranganTahananIsolasi' => ''
            ];

            $persyaratan_kondisi_visual = 'Baik';
            $persyaratan_kondisi_warna = 'Baik';
            $persyaratan_kondisi_pecah = 'Baik';
            $persyaratan_kondisi_permukaan = 'Baik';
            $persyaratan_kondisi_korosi = 'Baik';
            $persyaratan_pengujian_isolasi = 20;

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
                    $destinationFolder = public_path("gambar_isolator");

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

                        $gambarPaths[] = url("gambar_isolator/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $isolator = Isolator::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_isolator' => $request->tipe_isolator,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'kondisi_visual' => $request->kondisi_visual,
                'persyaratan_kondisi_visual' => $persyaratan_kondisi_visual,
                'keteranganVisualTampak' => $request->keteranganVisualTampak ?: $defaultKeteranganIsolator['keteranganVisualTampak'],
                'kondisi_warna' => $request->kondisi_warna,
                'persyaratan_kondisi_warna' => $persyaratan_kondisi_warna,
                'keteranganKondisiWarna' => $request->keteranganKondisiWarna ?: $defaultKeteranganIsolator['keteranganKondisiWarna'],
                'kondisi_pecah' => $request->kondisi_pecah,
                'persyaratan_kondisi_pecah' => $persyaratan_kondisi_pecah,
                'keteranganKondisiPecah' => $request->keteranganKondisiPecah ?: $defaultKeteranganIsolator['keteranganKondisiPecah'],
                'kondisi_permukaan' => $request->kondisi_permukaan,
                'persyaratan_kondisi_permukaan' => $persyaratan_kondisi_permukaan,
                'keteranganKondisiPermukaan' => $request->keteranganKondisiPermukaan ?: $defaultKeteranganIsolator['keteranganKondisiPermukaan'],
                'kondisi_korosi' => $request->kondisi_korosi,
                'persyaratan_kondisi_korosi' => $persyaratan_kondisi_korosi,
                'keteranganKondisiKorosi' => $request->keteranganKondisiKorosi ?: $defaultKeteranganIsolator['keteranganKondisiKorosi'],
                'pengujian_isolasi' => $request->pengujian_isolasi,
                'persyaratan_pengujian_isolasi' => $persyaratan_pengujian_isolasi,
                'keteranganTahananIsolasi' => $request->keteranganTahananIsolasi ?: $defaultKeteranganIsolator['keteranganTahananIsolasi'],
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);
        
            return redirect()->route('form-retur-isolator.create')->with('success', 'Data berhasil disimpan!');
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
        $isolator = Isolator::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Isolator'];

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

        $selectedUp3Id = $isolator->up3_id;
        $selectedUlpId = $isolator->ulp_id;
        $selectedPabrikanId = $isolator->pabrikan_id;
        $selectedTahunProduksi = $isolator->tahun_produksi;
        $selectedGudang = $isolator->gudang_id;
        $gambar = json_decode($isolator->gambar, true);

        return view('form.form_isolator_edit', compact('isolator', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'tahun_produksi' => 'required|string',
                'lokasi_akhir_terpasang' => 'required|string',
                'tipe_isolator' => 'required|in:Pin,Pin Post,Line Post,Suspension',
                'no_serial' => 'required|numeric',
                'kondisi_visual' => 'required|string',
                'keteranganVisualTampak' => 'nullable|string|max:55',
                'kondisi_warna' => 'required|string',
                'keteranganKondisiWarna' => 'nullable|string|max:55',
                'kondisi_pecah' => 'required|string',
                'keteranganKondisiPecah' => 'nullable|string|max:55',
                'kondisi_permukaan' => 'required|string',
                'keteranganKondisiPermukaan' => 'nullable|string|max:55',
                'kondisi_korosi' => 'required|string',
                'keteranganKondisiKorosi' => 'nullable|string|max:55',
                'pengujian_isolasi' => 'required|string',
                'keteranganTahananIsolasi' => 'nullable|string|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
                'status' => 'sometimes|string',
            ]);

            $defaultKeteranganIsolator = [
                'keteranganVisualTampak' => '',
                'keteranganKondisiWarna' => '',
                'keteranganKondisiPecah' => '',
                'keteranganKondisiPermukaan' => '',
                'keteranganKondisiKorosi' => '',
                'keteranganTahananIsolasi' => ''
            ];

            // Find the record or fail with 404
            $isolator = Isolator::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $isolator->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($isolator->gambar) {
                    foreach (json_decode($isolator->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_isolator");

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

                    $gambarPaths[] = url("gambar_isolator/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganIsolator as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $isolator->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $isolator->status = 'Approved';
                $isolator->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();

            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $isolator->status = 'Approved';
            //     $isolator->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
            // }

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
                $isolator->is_edited = true;
                // Jika ada perubahan data: update updated_at
                $isolator->updated_at = now();
            } elseif ($isApproving) {
                $isolator->is_edited = false;
                // Jika hanya approval: jangan update updated_at
                $isolator->updated_at = $oldData['updated_at'];
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
            //     $isolator->updated_at = now(); // Update timestamp perubahan
            // }

            // Jika hanya status yang diubah, jangan update updated_at
            // if (!$isEdited && $request->has('status')) {
            //     $isolator->timestamps = false; // Nonaktifkan timestamp otomatis
            // }

            $isolator->save();

            // Log success
            Log::info('Isolator updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Isolator update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Isolator', [
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
        $isolator = Isolator::findOrFail($id);
        $isolator->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
