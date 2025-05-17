<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\KelasPengujian;
use App\Models\KWHMeter;
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

class KWHController extends Controller
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
        $kategoriNames = ['KWH Meter 1', 'KWH Meter 3'];

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

        return view('form.form_kWh_meter', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tgl_inspeksi' => 'required|date',
                'id_pelanggan' => 'required|numeric',
                'tipe_kwh_meter' => 'required|in:Prabayar,Pascabayar',
                'no_serial' => 'required|numeric',
                'kondisi_body_kwh_meter' => 'required|string',
                'kondisi_segel_meterologi' => 'required|string',
                'kondisi_terminal' => 'required|string',
                'kondisi_stand_kwh_meter' => 'required|string',
                'kondisi_cover_terminal_kwh_meter' => 'required|string',
                'kondisi_nameplate' => 'required|string',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
            ]);

            $up3 = UP3::where('id', $request->up3_id)->where('uid_id', $request->uid_id)->first();
            $ulp = ULP::where('id', $request->ulp_id)->where('up3_id', $request->up3_id)->first();

            if (!$up3 || !$ulp) {
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!'], 400);
            }

            // Nilai default untuk setiap keterangan
            $defaultKeterangan = [
                'keterangan_masa_pakai' => '',
                'keterangan_body_kwh_meter' => 'Termasuk kaca depan meter.',
                'keterangan_segel_meterologi' => '',
                'keterangan_terminal' => '',
                'keterangan_stand_kwh_meter' => '',
                'keterangan_cover_terminal_kwh_meter' => 'Tutup terminal dan MCB.',
                'keterangan_nameplate' => '',
                'keterangan_uji_kesalahan' => ''
            ];

            $persyaratan_masa_pakai = 5;
            $kesesuaian_masa_pakai = $request->masa_pakai <= 5 ? 'yes' : 'no';

            $persyaratan_body_kwh_meter = 'Baik';
            $kesesuaian_body_kwh_meter = $request->kondisi_body_kwh_meter == 'Baik' ? 'yes' : 'no';

            $persyaratan_segel_meterologi = 'Baik';
            $kesesuaian_segel_meterologi = $request->kondisi_segel_meterologi == 'Baik' ? 'yes' : 'no';

            $persyaratan_terminal = 'Baik';
            $kesesuaian_terminal = $request->kondisi_terminal == 'Baik' ? 'yes' : 'no';

            $persyaratan_stand_kwh_meter = 'Baik';
            $kesesuaian_stand_kwh_meter = $request->kondisi_stand_kwh_meter == 'Baik' ? 'yes' : 'no';

            $persyaratan_cover_terminal_kwh_meter = 'Baik';
            $kesesuaian_cover_terminal_kwh_meter = $request->kondisi_cover_terminal_kwh_meter == 'Baik' ? 'yes' : 'no';

            $persyaratan_nameplate = 'Baik';
            $kesesuaian_nameplate = $request->kondisi_nameplate == 'Baik' ? 'yes' : 'no';

            $persyaratan_uji_kesalahan = 'Sesuai kelas';
            $satuan_uji_kesalahan = "%";
            $kesesuaian_uji_kesalahan = null;
            // Cek apakah nilai_uji_kesalahan diisi
            if (!is_null($request->nilai_uji_kesalahan)) {
                // Jika kelas_pengujian_id tidak diisi, set kesesuaian_uji_kesalahan ke null atau default
                if (is_null($request->kelas_pengujian_id)) {
                    $kesesuaian_uji_kesalahan = null; // Bisa juga 'unknown' atau lainnya sesuai kebutuhan
                } else {
                    // Jika nilai uji kesalahan diisi, maka kelas_pengujian harus dicek
                    // $kelasPengujian = KelasPengujian::where('kelas_pengujian', $request->kelas_pengujian_id)->first();
                    $kelasPengujian = KelasPengujian::find($request->kelas_pengujian_id);

                    if (!$kelasPengujian) {
                        return response()->json(['error' => 'Kelas pengujian tidak ditemukan di database'], 400);
                    }

                    // Bandingkan nilai uji kesalahan dengan batas kesalahan dari kelas pengujian
                    $kesesuaian_uji_kesalahan = abs($request->nilai_uji_kesalahan) <= $kelasPengujian->batas_kesalahan ? 'yes' : 'no';
                }
            }
            $keterangan_uji_kesalahan = "";

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
                    $destinationFolder = public_path("gambar_kwh");

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

                        $gambarPaths[] = url("gambar_kwh/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $meter = KWHMeter::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'id_pelanggan' => $request->id_pelanggan,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_kwh_meter' => $request->tipe_kwh_meter,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'persyaratan_masa_pakai' => $persyaratan_masa_pakai,
                'kesesuaian_masa_pakai' => $kesesuaian_masa_pakai,
                'keterangan_masa_pakai' => $request->keterangan_masa_pakai ?: $defaultKeterangan['keterangan_masa_pakai'],
                'kondisi_body_kwh_meter' => $request->kondisi_body_kwh_meter,
                'persyaratan_body_kwh_meter' => $persyaratan_body_kwh_meter,
                'kesesuaian_body_kwh_meter' => $kesesuaian_body_kwh_meter,
                'keterangan_body_kwh_meter' => $request->keterangan_body_kwh_meter ?: $defaultKeterangan['keterangan_body_kwh_meter'],
                'kondisi_segel_meterologi' => $request->kondisi_segel_meterologi,
                'persyaratan_segel_meterologi' => $persyaratan_segel_meterologi,
                'kesesuaian_segel_meterologi' => $kesesuaian_segel_meterologi,
                'keterangan_segel_meterologi' => $request->keterangan_segel_meterologi ?: $defaultKeterangan['keterangan_segel_meterologi'],
                'kondisi_terminal' => $request->kondisi_terminal,
                'persyaratan_terminal' => $persyaratan_terminal,
                'kesesuaian_terminal' => $kesesuaian_terminal,
                'keterangan_terminal' => $request->keterangan_terminal ?: $defaultKeterangan['keterangan_terminal'],
                'kondisi_stand_kwh_meter' => $request->kondisi_stand_kwh_meter,
                'persyaratan_stand_kwh_meter' => $persyaratan_stand_kwh_meter,
                'kesesuaian_stand_kwh_meter' => $kesesuaian_stand_kwh_meter,
                'keterangan_stand_kwh_meter' => $request->keterangan_stand_kwh_meter ?: $defaultKeterangan['keterangan_stand_kwh_meter'],
                'kondisi_cover_terminal_kwh_meter' => $request->kondisi_cover_terminal_kwh_meter,
                'persyaratan_cover_terminal_kwh_meter' => $persyaratan_cover_terminal_kwh_meter,
                'kesesuaian_cover_terminal_kwh_meter' => $kesesuaian_cover_terminal_kwh_meter,
                'keterangan_cover_terminal_kwh_meter' => $request->keterangan_cover_terminal_kwh_meter ?: $defaultKeterangan['keterangan_cover_terminal_kwh_meter'],
                'kondisi_nameplate' => $request->kondisi_nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'kesesuaian_nameplate' => $kesesuaian_nameplate,
                'keterangan_nameplate' => $request->keterangan_nameplate ?: $defaultKeterangan['keterangan_nameplate'],
                'nilai_uji_kesalahan' => $request->nilai_uji_kesalahan,
                'satuan_uji_kesalahan' => $satuan_uji_kesalahan,
                'persyaratan_uji_kesalahan' => $persyaratan_uji_kesalahan,
                'kelas_pengujian_id' => $request->kelas_pengujian_id,
                'kesesuaian_uji_kesalahan' => $kesesuaian_uji_kesalahan,
                'keterangan_uji_kesalahan' => $request->keterangan_uji_kesalahan ?: $defaultKeterangan['keterangan_uji_kesalahan'],
                'kesimpulan' => $request->kesimpulan,
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths),
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('form-retur-kwh-meter.create')->with('success', 'Form kWh Meter berhasil disimpan!');
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
        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['KWH Meter 1', 'KWH Meter 3'];

        // Ambil kategori berdasarkan nama
        $kategoriPabrikans = KategoriPabrikan::whereIn('nama_kategori', $kategoriNames)->get();

        // Ambil ID kategori yang ditemukan
        $kategoriIds = $kategoriPabrikans->pluck('id');

        // Ambil semua Pabrikan yang memiliki salah satu dari kategori tersebut -- Eager Loading
        $pabrikans = Pabrikan::with('kategoriPabrikans')->whereHas('kategoriPabrikans', function ($query) use ($kategoriNames) {
            $query->whereIn('nama_kategori', $kategoriNames);
        })->get();

        // Kategori UID
        $uids = UID::all();

        // Kategori UP3
        $up3s = UP3::all();

        // Kategori ULP
        $ulps = ULP::all();

        // List Gudang
        $gudangs = Gudang::all();

        // Kelas Pengujian
        $kelas_pengujians = KelasPengujian::select('id', 'kelas_pengujian')->distinct()->get();

        $kWh_Meter = KWHMeter::findOrFail($id);
        $selectedUp3Id = $kWh_Meter->up3_id;
        $selectedUlpId = $kWh_Meter->ulp_id;
        $selectedPabrikanId = $kWh_Meter->pabrikan_id;
        $selectedTahunProduksi = $kWh_Meter->tahun_produksi;
        $selectedKelasPengujianId = $kWh_Meter->kelas_pengujian_id;
        $selectedGudang = $kWh_Meter->gudang_id;

        $gambar = json_decode($kWh_Meter->gambar, true);

        return view('form.form_kWh_meter_edit', compact('kWh_Meter', 'uids', 'up3s', 'ulps', 'pabrikans', 'gudangs', 'kelas_pengujians', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedKelasPengujianId', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage. --- Ver 1
     */
    // public function update(Request $request, string $id)
    // {
    //     try {
    //         // Validation with corrected field name for kelas_pengujian
    //         $validated = $request->validate([
    //             'tgl_inspeksi' => 'required|date',
    //             'id_pelanggan' => 'required|numeric',
    //             'tipe_kwh_meter' => 'required|in:Prabayar,Pascabayar',
    //             'no_serial' => 'required|numeric',
    //             'keterangan_masa_pakai' => 'nullable|string|max:55',
    //             'kondisi_body_kwh_meter' => 'required|string',
    //             'keterangan_body_kwh_meter' => 'nullable|string|max:55',
    //             'kondisi_segel_meterologi' => 'required|string',
    //             'keterangan_segel_meterologi' => 'nullable|string|max:55',
    //             'kondisi_terminal' => 'required|string',
    //             'keterangan_terminal' => 'nullable|string|max:55',
    //             'kondisi_stand_kwh_meter' => 'required|string',
    //             'keterangan_stand_kwh_meter' => 'nullable|string|max:55',
    //             'kondisi_cover_terminal_kwh_meter' => 'required|string',
    //             'keterangan_cover_terminal_kwh_meter' => 'nullable|string|max:55',
    //             'kondisi_nameplate' => 'required|string',
    //             'keterangan_nameplate' => 'nullable|string|max:55',
    //             'nilai_uji_kesalahan' => 'nullable|numeric',
    //             'keterangan_uji_kesalahan' => 'nullable|string|max:55',
    //             'kelas_pengujian_id' => 'nullable|exists:kelas_pengujians,id',
    //             'kesimpulan' => 'required|string',
    //             'gambar' => 'nullable|array|max:4',
    //             'gambar.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
    //             'pabrikan_id' => 'required|exists:pabrikans,id',
    //             'uid_id' => 'required|exists:uids,id',
    //             'up3_id' => 'required|exists:up3s,id',
    //             'ulp_id' => 'required|exists:ulps,id',
    //             'gudang_id' => 'required|exists:gudangs,id',
    //             'tahun_produksi' => 'required|numeric',
    //             'status' => 'sometimes|string',
    //         ]);

    //         // Nilai default untuk setiap keterangan
    //         $defaultKeterangan = [
    //             'keterangan_masa_pakai' => '',
    //             'keterangan_body_kwh_meter' => 'Termasuk kaca depan meter.',
    //             'keterangan_segel_meterologi' => '',
    //             'keterangan_terminal' => '',
    //             'keterangan_stand_kwh_meter' => '',
    //             'keterangan_cover_terminal_kwh_meter' => 'Tutup terminal dan MCB.',
    //             'keterangan_nameplate' => '',
    //             'keterangan_uji_kesalahan' => ''
    //         ];

    //         // Find the record or fail with 404
    //         $kWh_Meter = KWHMeter::findOrFail($id);

    //         // **LOGIKA PERBANDINGAN UJI KESALAHAN**
    //         $kesesuaian_uji_kesalahan = null;

    //         // Cek jika nilai_uji_kesalahan atau kelas_pengujian_id diubah
    //         $isNilaiUjiChanged = $request->has('nilai_uji_kesalahan') &&
    //             $request->nilai_uji_kesalahan != $kWh_Meter->nilai_uji_kesalahan;

    //         $isKelasChanged = $request->has('kelas_pengujian_id') &&
    //             $request->kelas_pengujian_id != $kWh_Meter->kelas_pengujian_id;

    //         // Jika ada perubahan pada nilai uji atau kelas pengujian
    //         if ($isNilaiUjiChanged || $isKelasChanged) {
    //             // Jika nilai_uji_kesalahan diisi
    //             if (!is_null($request->nilai_uji_kesalahan)) {
    //                 // Jika kelas_pengujian_id juga diisi
    //                 if (!is_null($request->kelas_pengujian_id)) {
    //                     $kelasPengujian = KelasPengujian::find($request->kelas_pengujian_id);

    //                     if ($kelasPengujian) {
    //                         // Bandingkan nilai absolut dengan batas kesalahan
    //                         $kesesuaian_uji_kesalahan =
    //                             abs($request->nilai_uji_kesalahan) <= $kelasPengujian->batas_kesalahan
    //                             ? 'yes'
    //                             : 'no';
    //                     }
    //                 }
    //             }
    //             // Update field kesesuaian jika ada perubahan
    //             if (!is_null($kesesuaian_uji_kesalahan)) {
    //                 $validated['kesesuaian_uji_kesalahan'] = $kesesuaian_uji_kesalahan;
    //             }
    //         }

    //         // Simpan nilai lama sebelum diupdate
    //         $oldData = $kWh_Meter->getOriginal();

    //         // **Handle Gambar**
    //         if ($request->hasFile('gambar')) {
    //             // Hapus gambar lama
    //             if ($kWh_Meter->gambar) {
    //                 foreach (json_decode($kWh_Meter->gambar) as $oldImage) {
    //                     $oldImagePath = public_path(parse_url($oldImage, PHP_URL_PATH));
    //                     if (File::exists($oldImagePath)) {
    //                         File::delete($oldImagePath);
    //                     }
    //                 }
    //             }

    //             // Simpan gambar baru
    //             $gambarPaths = [];
    //             foreach ($request->file('gambar') as $file) {
    //                 $filename = Str::random(20) . '.jpg';
    //                 $destinationFolder = public_path("gambar_kwh");

    //                 // Buat folder jika belum ada
    //                 if (!File::exists($destinationFolder)) {
    //                     File::makeDirectory($destinationFolder, 0777, true, true);
    //                 }

    //                 $destinationPath = "{$destinationFolder}/{$filename}";
    //                 $imageType = $file->getClientOriginalExtension();
    //                 $image = match ($imageType) {
    //                     'jpg', 'jpeg' => imagecreatefromjpeg($file->getRealPath()),
    //                     'png' => imagecreatefrompng($file->getRealPath()),
    //                     'webp' => imagecreatefromwebp($file->getRealPath()),
    //                     default => null,
    //                 };

    //                 if (!$image) {
    //                     return response()->json(['error' => 'Format gambar tidak didukung'], 400);
    //                 }

    //                 $width = imagesx($image);
    //                 $height = imagesy($image);
    //                 $newWidth = 1080;
    //                 $newHeight = ($newWidth / $width) * $height;

    //                 $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    //                 imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    //                 imagejpeg($resizedImage, $destinationPath, 60);

    //                 imagedestroy($image);
    //                 imagedestroy($resizedImage);

    //                 $gambarPaths[] = url("gambar_kwh/{$filename}");
    //             }

    //             $validated['gambar'] = json_encode($gambarPaths);
    //         }

    //         // Terapkan nilai default jika field tidak diisi
    //         foreach ($defaultKeterangan as $key => $value) {
    //             if (empty($validated[$key])) {
    //                 $validated[$key] = $value;
    //             }
    //         }

    //         // Update the record with all validated data
    //         $kWh_Meter->fill($validated);

    //         // Menambahkan perubahan status berdasarkan role dan logika approval
    //         $user = auth()->user();
    //         $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

    //         if ($isApproving) {
    //             $kWh_Meter->status = 'Approved';
    //             $kWh_Meter->approved_by = Auth::id();
    //         }

    //         // Cek perubahan data yang sebenarnya (selain status dan approved_by)
    //         $isDataChanged = false;
    //         $changedFields = [];
    //         foreach ($validated as $key => $value) {
    //             if (!in_array($key, ['status', 'approved_by']) && $oldData[$key] != $value) {
    //                 $isDataChanged = true;
    //                 $changedFields[] = $key;
    //                 break;
    //             }
    //         }

    //         // Logika timestamp
    //         if ($isDataChanged) {
    //             // Jika ada perubahan data: update updated_at
    //             $kWh_Meter->updated_at = now();
    //         } elseif ($isApproving) {
    //             // Jika hanya approval: jangan update updated_at
    //             $kWh_Meter->updated_at = $oldData['updated_at'];
    //         }

    //         // Calculate masa_pakai if tahun_produksi is provided
    //         if ($request->filled('tahun_produksi')) {
    //             $kWh_Meter->masa_pakai = date('Y') - $request->tahun_produksi;
    //         }

    //         $kWh_Meter->save();

    //         // Log success
    //         Log::info('KWH Meter updated successfully', [
    //             'id' => $id,
    //             'changed_fields' => $changedFields,
    //             'is_approving' => $isApproving,
    //             'is_data_changed' => $isDataChanged
    //         ]);

    //         return redirect('/unapproved')
    //             ->with('success', 'Data berhasil diperbarui!');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Log validation errors
    //         Log::warning('Validation failed during KWH Meter update', [
    //             'id' => $id,
    //             'errors' => $e->errors()
    //         ]);

    //         // Redirect back with errors and input
    //         return back()->withErrors($e->errors())->withInput();
    //     } catch (\Exception $e) {
    //         // Log general errors
    //         Log::error('Error updating KWH Meter', [
    //             'id' => $id,
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         // Redirect back with generic error
    //         return back()
    //             ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.'])
    //             ->withInput();
    //     }
    // }

    public function update(Request $request, string $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'id_pelanggan' => 'required|numeric',
                'tipe_kwh_meter' => 'required|in:Prabayar,Pascabayar',
                'no_serial' => 'required|numeric',
                'keterangan_masa_pakai' => 'nullable|string|max:55',
                'kondisi_body_kwh_meter' => 'required|string',
                'keterangan_body_kwh_meter' => 'nullable|string|max:55',
                'kondisi_segel_meterologi' => 'required|string',
                'keterangan_segel_meterologi' => 'nullable|string|max:55',
                'kondisi_terminal' => 'required|string',
                'keterangan_terminal' => 'nullable|string|max:55',
                'kondisi_stand_kwh_meter' => 'required|string',
                'keterangan_stand_kwh_meter' => 'nullable|string|max:55',
                'kondisi_cover_terminal_kwh_meter' => 'required|string',
                'keterangan_cover_terminal_kwh_meter' => 'nullable|string|max:55',
                'kondisi_nameplate' => 'required|string',
                'keterangan_nameplate' => 'nullable|string|max:55',
                'nilai_uji_kesalahan' => 'nullable|numeric',
                'keterangan_uji_kesalahan' => 'nullable|string|max:55',
                'kelas_pengujian_id' => 'nullable|exists:kelas_pengujians,id',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
                'gudang_id' => 'required|exists:gudangs,id',
                'tahun_produksi' => 'required|numeric',
                'status' => 'sometimes|string',
            ]);

            // Nilai default untuk setiap keterangan
            $defaultKeterangan = [
                'keterangan_masa_pakai' => '',
                'keterangan_body_kwh_meter' => 'Termasuk kaca depan meter.',
                'keterangan_segel_meterologi' => '',
                'keterangan_terminal' => '',
                'keterangan_stand_kwh_meter' => '',
                'keterangan_cover_terminal_kwh_meter' => 'Tutup terminal dan MCB.',
                'keterangan_nameplate' => '',
                'keterangan_uji_kesalahan' => ''
            ];

            // Temukan record yang akan diupdate
            $kWh_Meter = KWHMeter::findOrFail($id);
            $oldData = $kWh_Meter->getOriginal();

            // Logika perbandingan uji kesalahan
            $kesesuaian_uji_kesalahan = null;

            // Cek jika nilai_uji_kesalahan atau kelas_pengujian_id diubah
            $isNilaiUjiChanged = $request->has('nilai_uji_kesalahan') &&
                $request->nilai_uji_kesalahan != $kWh_Meter->nilai_uji_kesalahan;

            $isKelasChanged = $request->has('kelas_pengujian_id') &&
                $request->kelas_pengujian_id != $kWh_Meter->kelas_pengujian_id;

            // Jika ada perubahan pada nilai uji atau kelas pengujian
            if ($isNilaiUjiChanged || $isKelasChanged) {
                if (!is_null($request->nilai_uji_kesalahan) && !is_null($request->kelas_pengujian_id)) {
                    $kelasPengujian = KelasPengujian::find($request->kelas_pengujian_id);

                    if ($kelasPengujian) {
                        $kesesuaian_uji_kesalahan =
                            abs($request->nilai_uji_kesalahan) <= $kelasPengujian->batas_kesalahan
                            ? 'yes'
                            : 'no';
                    }
                }

                if (!is_null($kesesuaian_uji_kesalahan)) {
                    $validated['kesesuaian_uji_kesalahan'] = $kesesuaian_uji_kesalahan;
                }
            }

            // Handle upload gambar
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($kWh_Meter->gambar) {
                    foreach (json_decode($kWh_Meter->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_kwh");

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

                    $gambarPaths[] = url("gambar_kwh/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeterangan as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Deteksi perubahan data
            $isDataChanged = false;
            $excludedFields = ['status', 'approved_by', 'updated_at', 'created_at'];

            foreach ($validated as $key => $value) {
                if (!in_array($key, $excludedFields) && $oldData[$key] != $value) {
                    $isDataChanged = true;
                    break;
                }
            }

            // Handle approval by PIC/Admin
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] == 'Unapproved';

            if ($isApproving) {
                $kWh_Meter->status = 'Approved';
                $kWh_Meter->approved_by = Auth::id();
            }

            // Update data
            $kWh_Meter->fill($validated);

            // Update timestamp jika ada perubahan
            if ($isDataChanged) {
                $kWh_Meter->is_edited = true;
                $kWh_Meter->updated_at = now();
            } else {
                $kWh_Meter->is_edited = false;
            }

            // Hitung masa pakai jika tahun produksi diisi
            if ($request->filled('tahun_produksi')) {
                $newMasaPakai = date('Y') - $request->tahun_produksi;
                if ($newMasaPakai != $kWh_Meter->masa_pakai) {
                    $kWh_Meter->masa_pakai = $newMasaPakai;
                    $isDataChanged = true;
                }
            }

            // Set last editor            
            $kWh_Meter->save();

            // Log aktivitas
            Log::info('KWH Meter updated', [
                'id' => $id,
                'user' => Auth::id(),
                'changed' => $isDataChanged,
                'changes' => $kWh_Meter->getChanges()
            ]);

            return redirect('/unapproved')->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed during KWH Meter update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating KWH Meter', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

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
        $kWh_Meter = KWHMeter::findOrFail($id);
        $kWh_Meter->delete();

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

    public function approve(string $id)
    {
        try {
            $kWh_Meter = KWHMeter::findOrFail($id);
            $kWh_Meter->status = 'Approved';
            $kWh_Meter->approved_by = Auth::id(); // Simpan user yang mengapprove
            $kWh_Meter->save();

            \Log::info('KWH Meter update status successfully', ['id' => $id]);
            dd($kWh_Meter);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            \Log::warning('Validation failed during KWH Meter update status', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        }
        // return redirect()->route('form-unapproved')->with('success', 'Status berhasil diubah menjadi Approved!');
    }

    private function hasDataChanges(Request $request, KWHMeter $kWh_Meter): bool
    {
        $excludedFields = ['_token', '_method', 'status'];
        $currentData = $kWh_Meter->toArray();

        foreach ($request->except($excludedFields) as $key => $value) {
            // Handle khusus untuk field yang mungkin formatnya berbeda
            if ($key === 'gambar') continue; // Gambar sudah dihandle khusus

            if (array_key_exists($key, $currentData)) {
                $currentValue = $currentData[$key];

                // Konversi tipe data untuk komparasi
                if (is_numeric($currentValue)) {
                    $value = is_numeric($value) ? $value + 0 : $value;
                    $currentValue = $currentValue + 0;
                }

                if ($value != $currentValue) {
                    return true;
                }
            }
        }

        return false;
    }
}
