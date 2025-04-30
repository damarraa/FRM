<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\LightningArrester;
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

class LAController extends Controller
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
        $kategoriNames = ['Lightning Arrester'];

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

        return view('form.form_lightning_arrester', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_la' => 'required|in:Polymer,Keramik',
                'no_serial' => 'required|numeric',
                'kondisi_visual' => 'required|string',
                'keterangan_kondisi_visual' => 'nullable|max:55',
                'uji_tahanan' => 'required|numeric',
                'keterangan_uji_ketahanan' => 'nullable|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $up3 = UP3::where('id', $request->up3_id)->where('uid_id', $request->uid_id)->first();
            $ulp = ULP::where('id', $request->ulp_id)->where('up3_id', $request->up3_id)->first();

            if (!$up3 || !$ulp) {
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!']);
            }

            $defaultKeteranganLA = [
                'keterangan_kondisi_visual' => '',
                'keterangan_uji_ketahanan' => ''
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
                    $destinationFolder = public_path("gambar_lightning_arrester");

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

                        $gambarPaths[] = url("gambar_lightning_arrester/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $la = LightningArrester::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'masa_pakai' => $request->masa_pakai,
                'tipe_la' => $request->tipe_la,
                'no_serial' => $request->no_serial,
                'kondisi_visual' => $request->kondisi_visual,
                'keterangan_kondisi_visual' => $request->keterangan_kondisi_visual ?: $defaultKeteranganLA['keterangan_kondisi_visual'],
                'uji_tahanan' => $request->uji_tahanan,
                'keterangan_uji_ketahanan' => $request->keterangan_uji_ketahanan ?: $defaultKeteranganLA['keterangan_uji_ketahanan'],
                'gambar' => json_encode($gambarPaths),
                'kesimpulan' => $request->kesimpulan,
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-lightning_arrester.create')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
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
        $la = LightningArrester::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Lightning Arrester'];

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

        $selectedUp3Id = $la->up3_id;
        $selectedUlpId = $la->ulp_id;
        $selectedPabrikanId = $la->pabrikan_id;
        $selectedTahunProduksi = $la->tahun_produksi;
        $selectedGudang = $la->gudang_id;
        $gambar = json_decode($la->gambar, true);

        return view('form.form_lightning_arrester_edit', compact('la', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'tipe_la' => 'required|in:Polymer,Keramik',
                'no_serial' => 'required|numeric',
                'kondisi_visual' => 'required|string',
                'keterangan_kondisi_visual' => 'nullable|string|max:55',
                'uji_tahanan' => 'nullable|numeric',
                'keterangan_uji_ketahanan' => 'nullable|string|max:55',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            $defaultKeteranganLA = [
                'keterangan_kondisi_visual' => '',
                'keterangan_uji_ketahanan' => ''
            ];

            $la = LightningArrester::findOrFail($id);

            $oldData = $la->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($la->gambar) {
                    foreach (json_decode($la->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_lightning_arrester");

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

                    $gambarPaths[] = url("gambar_lightning_arrester/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganLA as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $la->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $la->status = 'Approved';
                $la->approved_by = Auth::id();
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
                // Jika ada perubahan data: update updated_at
                $la->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $la->updated_at = $oldData['updated_at'];
            }

            $la->save();

            // Log success
            Log::info('Lightning Arrester updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Lightning Arrester update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Lightning Arrester', [
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
        $la = LightningArrester::findOrFail($id);
        $la->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
