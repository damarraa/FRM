<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
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

class CablePowerController extends Controller
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
        $kategoriNames = ['Power Cable'];

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

        return view('form.form_cable_power', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tahun_pemasangan' => 'required|string',
                'jenis_cable_power' => 'required|string',
                'ukuran_cable_power' => 'required|string',
                'luas_penampang' => 'required|numeric',
                'panjang_cable_power' => 'required|numeric',
                'nilai_pemeriksaan_kondisi_visual' => 'required|string',
                'nilai_pengujian_dimensi' => 'required|numeric',
                'kesimpulan_k6' => 'required|string',
                'kesimpulan_k8' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'gudang_id' => 'required|exists:gudangs,id',
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
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!'], 400);
            }

            // Start Logika kolom Persyaratan & Kesesuaian
            // Hitung rentang toleransi ±1% dari luas_penampang
            $luasPenampang = $request->luas_penampang;
            $toleransi = $luasPenampang * 0.01; // 1% dari luas penampang
            $min = $luasPenampang - $toleransi;
            $max = $luasPenampang + $toleransi;

            // Validasi nilai_pengujian_dimensi
            $nilaiPengujianDimensi = $request->nilai_pengujian_dimensi;

            // Tentukan kesesuaian pengujian dimensi
            $kesesuaian_pengujian_dimensi = ($nilaiPengujianDimensi >= $min && $nilaiPengujianDimensi <= $max) ? 'yes' : 'no';

            // Jika tidak sesuai, catat error ke log dan kembalikan respons error
            if ($kesesuaian_pengujian_dimensi === 'no') {
                Log::info('Nilai pengujian dimensi tidak sesuai dengan rentang toleransi ±1% dari luas penampang.', [
                    'luas_penampang' => $luasPenampang,
                    'nilai_pengujian_dimensi' => $nilaiPengujianDimensi,
                    'min_toleransi' => $min,
                    'max_toleransi' => $max,
                ]);

                // return response()->json([
                //     'error' => 'Nilai pengujian dimensi tidak sesuai dengan rentang toleransi ±1% dari luas penampang.'
                // ], 422); // 422 adalah status code untuk Unprocessable Entity (validasi gagal)
            }

            $defaultKeteranganCablePower = [
                'keterangan_pemeriksaan' => '',
                'keterangan_pengujian_dimensi' => '+/- 1% dari diameter standar konduktor',
                'keterangan_uji_tahanan_isolasi' => 'Nilai Tahanan Isolasi Hanya Sebagai Data Pengukuran'
            ];

            $satuan_pemeriksaan_kondisi_visual = '-';
            $satuan_pengujian_dimensi = 'mm';
            $satuan_uji_tahanan_isolasi = 'MΩ';

            $persyaratan_pemeriksaan_kondisi_visual = 'Baik (Tidak Rantas, Tidak Mekar & Isolasi Tidak Rusak)';
            $persyaratan_pengujian_dimensi = '+/- 1%';
            $persyaratan_uji_tahanan_isolasi = 'Tidak tembus atau bernilai > 0 ohm';

            $kesesuaian_pemeriksaan_kondisi_visual = $request->nilai_pemeriksaan_kondisi_visual == 'Baik' ? 'yes' : 'no';
            $kesesuaian_uji_tahanan_isolasi = $request->nilai_uji_tahanan_isolasi > 0 ? 'yes' : 'no';
            // End Logika kolom Persyaratan & Kesesuaian

            // Generate nomor surat
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
                    $destinationFolder = public_path("gambar_cable_power");

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

                        $gambarPaths[] = url("gambar_cable_power/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $mcb = CablePower::create([
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'no_surat' => $nomorSurat,
                'tahun_pemasangan' => $request->tahun_pemasangan,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'jenis_cable_power' => $request->jenis_cable_power,
                'ukuran_cable_power' => $request->ukuran_cable_power,
                'luas_penampang' => $request->luas_penampang,
                'panjang_cable_power' => $request->panjang_cable_power,
                'nilai_pemeriksaan_kondisi_visual' => $request->nilai_pemeriksaan_kondisi_visual,
                'satuan_pemeriksaan_kondisi_visual' => $satuan_pemeriksaan_kondisi_visual,
                'persyaratan_pemeriksaan_kondisi_visual' => $persyaratan_pemeriksaan_kondisi_visual,
                'kesesuaian_pemeriksaan_kondisi_visual' => $kesesuaian_pemeriksaan_kondisi_visual,
                'keterangan_pemeriksaan' => $request->keterangan_pemeriksaan ?: $defaultKeteranganCablePower['keterangan_pemeriksaan'],
                'nilai_pengujian_dimensi' => $request->nilai_pengujian_dimensi,
                'satuan_pengujian_dimensi' => $satuan_pengujian_dimensi,
                'persyaratan_pengujian_dimensi' => $persyaratan_pengujian_dimensi,
                'kesesuaian_pengujian_dimensi' => $kesesuaian_pengujian_dimensi,
                'keterangan_pengujian_dimensi' => $defaultKeteranganCablePower['keterangan_pengujian_dimensi'],
                'nilai_uji_tahanan_isolasi' => $request->nilai_uji_tahanan_isolasi,
                'satuan_uji_tahanan_isolasi' => $satuan_uji_tahanan_isolasi,
                'persyaratan_uji_tahanan_isolasi' => $persyaratan_uji_tahanan_isolasi,
                // 'kesesuaian_uji_tahanan_isolasi' => $request->has('kesesuaian_uji_tahanan_isolasi') ? 'yes' : 'no',
                'kesesuaian_uji_tahanan_isolasi' => $kesesuaian_uji_tahanan_isolasi,
                'keterangan_uji_tahanan_isolasi' => $request->keterangan_uji_tahanan_isolasi ?: $defaultKeteranganCablePower['keterangan_uji_tahanan_isolasi'],
                'kesimpulan_k6' => $request->kesimpulan_k6,
                'kesimpulan_k8' => $request->kesimpulan_k8,
                'gudang_id' => $request->gudang_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths),
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-cable-power.create')->with('success', 'Data berhasil disimpan!');
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
    public function edit(string $id): View
    {
        // Get data by Id
        $cable_powers = CablePower::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Power Cable'];

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

        $selectedUp3Id = $cable_powers->up3_id;
        $selectedUlpId = $cable_powers->ulp_id;
        $selectedTahunPemasangan = (string)$cable_powers->tahun_pemasangan;
        // $selectedPabrikanId = $cable_powers->pabrikan_id;
        $selectedGudang = $cable_powers->gudang_id;
        $gambar = json_decode($cable_powers->gambar, true);

        return view('form.form_cable_power_edit', compact('cable_powers', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedTahunPemasangan', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'lokasi_akhir_terpasang' => 'required|string',
                'tahun_pemasangan' => 'required|string',
                'jenis_cable_power' => 'required|string',
                'ukuran_cable_power' => 'required|string',
                'luas_penampang' => 'required|numeric',
                'panjang_cable_power' => 'required|numeric',
                'nilai_pemeriksaan_kondisi_visual' => 'required|string',
                'keterangan_pemeriksaan' => 'nullable|string|max:55',
                'nilai_pengujian_dimensi' => 'required|numeric',
                'nilai_uji_tahanan_isolasi' => 'nullable|numeric',
                'kesimpulan_k6' => 'required|string',
                'kesimpulan_k8' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:8192',
                'jenis_form_id' => 'required|exists:jenis_forms,id',
                'gudang_id' => 'required|exists:gudangs,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            // Hitung rentang toleransi ±1% dari luas_penampang
            $luasPenampang = $request->luas_penampang;
            $toleransi = $luasPenampang * 0.01; // 1% dari luas penampang
            $min = $luasPenampang - $toleransi;
            $max = $luasPenampang + $toleransi;

            // Validasi nilai_pengujian_dimensi
            $nilaiPengujianDimensi = $request->nilai_pengujian_dimensi;

            // Tentukan kesesuaian pengujian dimensi
            $kesesuaian_pengujian_dimensi = ($nilaiPengujianDimensi >= $min && $nilaiPengujianDimensi <= $max) ? 'yes' : 'no';

            // Jika tidak sesuai, catat error ke log dan kembalikan respons error
            if ($kesesuaian_pengujian_dimensi === 'no') {
                Log::info('Nilai pengujian dimensi tidak sesuai dengan rentang toleransi ±1% dari luas penampang.', [
                    'luas_penampang' => $luasPenampang,
                    'nilai_pengujian_dimensi' => $nilaiPengujianDimensi,
                    'min_toleransi' => $min,
                    'max_toleransi' => $max,
                ]);

                // return response()->json([
                //     'error' => 'Nilai pengujian dimensi tidak sesuai dengan rentang toleransi ±1% dari luas penampang.'
                // ], 422); // 422 adalah status code untuk Unprocessable Entity (validasi gagal)
            }

            // Default keterangan
            $defaultKeteranganCablePower = [
                'keterangan_pemeriksaan' => '',
                'keterangan_pengujian_dimensi' => '+/- 1% dari diameter standar konduktor',
                'keterangan_uji_tahanan_isolasi' => 'Nilai Tahanan Isolasi Hanya Sebagai Data Pengukuran'
            ];

            // Temukan data yang akan diupdate
            $cable_powers = CablePower::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $cable_powers->getOriginal();

            // Handle gambar
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($cable_powers->gambar) {
                    foreach (json_decode($cable_powers->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_cable_power");

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

                    $gambarPaths[] = url("gambar_cable_power/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganCablePower as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update data
            $cable_powers->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $cable_powers->status = 'Approved';
                $cable_powers->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();
            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $cable_powers->status = 'Approved';
            //     $cable_powers->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
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
                // Jika ada perubahan data: update updated_at
                $cable_powers->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $cable_powers->updated_at = $oldData['updated_at'];
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
            //     $cable_powers->updated_at = now(); // Update timestamp perubahan
            // }

            $cable_powers->save();

            // Log success
            Log::info('Power cable updated successfully', ['id' => $id]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during power cable update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating power cable', [
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
        $cable_powers = CablePower::findOrFail($id);
        $cable_powers->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }

    public function getUlps(Request $request)
    {
        if ($request->has('up3_id')) {
            $ulps = ULP::where('up3_id', $request->up3_id)->get();
            return response()->json($ulps);
        }
        return response()->json([]);
    }

    public function getGudangs(Request $request)
    {
        if ($request->has('up3_id')) {
            $gudangs = Gudang::where('up3_id', $request->up3_id)->get();
            return response()->json($gudangs);
        }
        return response()->json([]);
    }
}
