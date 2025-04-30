<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\TrafoTegangan;
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

class PTController extends Controller
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
        $kategoriNames = ['PT'];

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

        return view('form.form_trafo_tegangan', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tahun_produksi' => 'required|string',
                'tipe_trafo_tegangan' => 'required|in:Indoor,Outdoor',
                'no_serial' => 'required|numeric',
                'rasio' => 'required|string',
                'retak_pada_resin' => 'required|string',
                'nameplate' => 'required|string',
                'penandaan_terminal' => 'required|string',
                'terminal_primer' => 'required|string',
                'terminal_sekunder' => 'required|string',
                'kelengkapan_baut_primer' => 'required|string',
                'kelengkapan_baut_sekunder' => 'required|string',
                'cover_terminal' => 'required|string',
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
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!'], 400);
            }

            // Start Logika kolom Persyaratan & Kesesuaian
            $defaultKeteranganPT = [
                'keterangan_nilai_pengujian_primer' => '',
                'keterangan_nilai_pengujian_sekunder' => '',
                'keterangan_akurasi_rasio_tegangan' => ''
            ];

            $satuan_nilai_pengujian_primer = 'MΩ';
            $satuan_nilai_pengujian_sekunder = 'MΩ';
            $satuan_akurasi_rasio_tegangan = '%';

            $persyaratan_retak = 'Tidak ada';
            $persyaratan_nameplate = 'Ada';
            $persyaratan_penandaan_terminal = 'Ada';
            $persyaratan_terminal_primer = 'Ada';
            $persyaratan_terminal_sekunder = 'Ada';
            $persyaratan_kelengkapan_baut_primer = 'Ada';
            $persyaratan_kelengkapan_baut_sekunder = 'Ada';
            $persyaratan_cover_terminal = 'Ada';

            $persyaratan_nilai_pengujian_primer = '> 20 MΩ';
            $persyaratan_nilai_pengujian_sekunder = '> 20 MΩ';
            $persyaratan_akurasi_rasio_tegangan = 'Sesuai Kelas';

            $kesesuaian_retak = $request->retak_pada_resin == 'Tidak ada' ? 'yes' : 'no';
            $kesesuaian_nameplate = $request->nameplate == 'Ada' ? 'yes' : 'no';
            $kesesuaian_penandaan_terminal = $request->penandaan_terminal == 'Ada' ? 'yes' : 'no';
            $kesesuaian_terminal_primer = $request->terminal_primer == 'Ada' ? 'yes' : 'no';
            $kesesuaian_terminal_sekunder = $request->terminal_sekunder == 'Ada' ? 'yes' : 'no';
            $kesesuaian_baut_primer = $request->kelengkapan_baut_primer == 'Ada' ? 'yes' : 'no';
            $kesesuaian_baut_sekunder = $request->kelengkapan_baut_sekunder == 'Ada' ? 'yes' : 'no';
            $kesesuaian_cover_terminal = $request->cover_terminal == 'Ada' ? 'yes' : 'no';

            $kesesuaian_nilai_pengujian_primer = $request->nilai_pengujian_primer > 20 ? 'yes' : 'no';
            $kesesuaian_nilai_pengujian_sekunder = $request->nilai_pengujian_sekunder > 20 ? 'yes' : 'no';
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
                    $destinationFolder = public_path("gambar_trafo_tegangan");

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

                        $gambarPaths[] = url("gambar_trafo_tegangan/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $trafo_tegangan = TrafoTegangan::create([
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'no_surat' => $nomorSurat,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'masa_pakai' => $request->masa_pakai,
                'tipe_trafo_tegangan' => $request->tipe_trafo_tegangan,
                'no_serial' => $request->no_serial,
                'rasio' => $request->rasio,
                'retak_pada_resin' => $request->retak_pada_resin,
                'persyaratan_retak' => $persyaratan_retak,
                'kesesuaian_retak' => $kesesuaian_retak,
                'nameplate' => $request->nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'kesesuaian_nameplate' => $kesesuaian_nameplate,
                'penandaan_terminal' => $request->penandaan_terminal,
                'persyaratan_penandaan_terminal' => $persyaratan_penandaan_terminal,
                'kesesuaian_penandaan_terminal' => $kesesuaian_penandaan_terminal,
                'terminal_primer' => $request->terminal_primer,
                'persyaratan_terminal_primer' => $persyaratan_terminal_primer,
                'kesesuaian_terminal_primer' => $kesesuaian_terminal_primer,
                'terminal_sekunder' => $request->terminal_sekunder,
                'persyaratan_terminal_sekunder' => $persyaratan_terminal_sekunder,
                'kesesuaian_terminal_sekunder' => $kesesuaian_terminal_sekunder,
                'kelengkapan_baut_primer' => $request->kelengkapan_baut_primer,
                'persyaratan_baut_primer' => $persyaratan_kelengkapan_baut_primer,
                'kesesuaian_baut_primer' => $kesesuaian_baut_primer,
                'kelengkapan_baut_sekunder' => $request->kelengkapan_baut_sekunder,
                'persyaratan_baut_sekunder' => $persyaratan_kelengkapan_baut_sekunder,
                'kesesuaian_baut_sekunder' => $kesesuaian_baut_sekunder,
                'cover_terminal' => $request->cover_terminal,
                'persyaratan_cover_terminal' => $persyaratan_cover_terminal,
                'kesesuaian_cover_terminal' => $kesesuaian_cover_terminal,
                'nilai_pengujian_primer' => $request->nilai_pengujian_primer,
                'satuan_nilai_pengujian_primer' => $satuan_nilai_pengujian_primer,
                'persyaratan_nilai_pengujian_primer' => $persyaratan_nilai_pengujian_primer,
                'kesesuaian_nilai_pengujian_primer' => $kesesuaian_nilai_pengujian_primer,
                'keterangan_nilai_pengujian_primer' => $request->keterangan_nilai_pengujian_primer ?: $defaultKeteranganPT['keterangan_nilai_pengujian_primer'],
                'nilai_pengujian_sekunder' => $request->nilai_pengujian_sekunder,
                'satuan_nilai_pengujian_sekunder' => $satuan_nilai_pengujian_sekunder,
                'persyaratan_nilai_pengujian_sekunder' => $persyaratan_nilai_pengujian_sekunder,
                'kesesuaian_nilai_pengujian_sekunder' => $kesesuaian_nilai_pengujian_sekunder,
                'keterangan_nilai_pengujian_sekunder' => $request->keterangan_nilai_pengujian_sekunder ?: $defaultKeteranganPT['keterangan_nilai_pengujian_sekunder'],
                'akurasi_rasio_tegangan' => $request->akurasi_rasio_tegangan,
                'satuan_akurasi_rasio_tegangan' => $satuan_akurasi_rasio_tegangan,
                'persyaratan_akurasi_rasio_tegangan' => $persyaratan_akurasi_rasio_tegangan,
                'kesesuaian_akurasi_rasio_tegangan' => $request->has('kesesuaian_akurasi_rasio_tegangan') ? 'yes' : 'no',
                'keterangan_akurasi_rasio_tegangan' => $request->keterangan_akurasi_rasio_tegangan ?: $defaultKeteranganPT['keterangan_akurasi_rasio_tegangan'],
                'kelas_akurasi' => $request->kelas_akurasi,
                'kesimpulan' => $request->kesimpulan,
                'pabrikan_id' => $request->pabrikan_id,
                'gudang_id' => $request->gudang_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths),
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-pt.create')->with('success', 'Data berhasil disimpan!');
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
        $trafo_tegangan = TrafoTegangan::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['PT'];

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

        $selectedUp3Id = $trafo_tegangan->up3_id;
        $selectedUlpId = $trafo_tegangan->ulp_id;
        $selectedTahunProduksi = $trafo_tegangan->tahun_produksi;
        $selectedPabrikanId = $trafo_tegangan->pabrikan_id;
        $selectedGudang = $trafo_tegangan->gudang_id;
        $gambar = json_decode($trafo_tegangan->gambar, true);

        return view('form.form_trafo_tegangan_edit', compact('trafo_tegangan', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->merge([
                'kesesuaian_akurasi_rasio_tegangan' => $request->has('kesesuaian_akurasi_rasio_tegangan') ? 'yes' : 'no',
            ]);
            // Validasi input
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'lokasi_akhir_terpasang' => 'required|string',
                'tahun_produksi' => 'required|string',
                'tipe_trafo_tegangan' => 'required|in:Indoor,Outdoor',
                'no_serial' => 'required|numeric',
                'rasio' => 'required|string',
                'retak_pada_resin' => 'required|string',
                'nameplate' => 'required|string',
                'penandaan_terminal' => 'required|string',
                'terminal_primer' => 'required|string',
                'terminal_sekunder' => 'required|string',
                'kelengkapan_baut_primer' => 'required|string',
                'kelengkapan_baut_sekunder' => 'required|string',
                'cover_terminal' => 'required|string',
                'nilai_pengujian_primer' => 'nullable|numeric',
                'keterangan_nilai_pengujian_primer' => 'nullable|string|max:55',
                'nilai_pengujian_sekunder' => 'nullable|numeric',
                'keterangan_nilai_pengujian_sekunder' => 'nullable|string|max:55',
                'akurasi_rasio_tegangan' => 'nullable|numeric',
                'keterangan_akurasi_rasio_tegangan' => 'nullable|string|max:55',
                'kesesuaian_akurasi_rasio_tegangan' => 'nullable|in:yes,no',
                'kelas_akurasi' => 'nullable|string',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            // Default keterangan
            $defaultKeteranganPT = [
                'keterangan_nilai_pengujian_primer' => '',
                'keterangan_nilai_pengujian_sekunder' => '',
                'keterangan_akurasi_rasio_tegangan' => ''
            ];

            // Temukan data yang akan diupdate
            $trafo_tegangan = TrafoTegangan::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $trafo_tegangan->getOriginal();

            // Handle gambar
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($trafo_tegangan->gambar) {
                    foreach (json_decode($trafo_tegangan->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_trafo_tegangan");

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

                    $gambarPaths[] = url("gambar_trafo_tegangan/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganPT as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update data
            $trafo_tegangan->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $trafo_tegangan->status = 'Approved';
                $trafo_tegangan->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();
            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $trafo_tegangan->status = 'Approved';
            //     $trafo_tegangan->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
            // }

            // Cek apakah ada perubahan pada kolom selain status
            // $isEdited = false;
            // foreach ($validated as $key => $value) {
            //     if ($key !== 'status' && $oldData[$key] != $value) {
            //         $isEdited = true;
            //         break;
            //     }
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

            // Logika timestamp:
            if ($isDataChanged) {
                // Jika ada perubahan data: update updated_at
                $trafo_tegangan->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $trafo_tegangan->updated_at = $oldData['updated_at'];
            }

            // Jika ada perubahan pada kolom selain status, update updated_at
            // if ($isEdited) {
            //     $trafo_tegangan->updated_at = now(); // Update timestamp perubahan
            // }

            $trafo_tegangan->save();

            // Log success
            Log::info('Trafo Tegangan (PT) updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Trafo Tegangan (PT) update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Trafo Tegangan (PT)', [
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
        $trafo_tegangan = TrafoTegangan::findOrFail($id);
        $trafo_tegangan->delete();

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
