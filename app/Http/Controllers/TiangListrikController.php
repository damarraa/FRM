<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\TiangListrik;
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

class TiangListrikController extends Controller
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
        $kategoriNames = ['Tiang Baja', 'Tiang Beton'];

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

        return view('form.form_tiang_listrik', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'masa_pakai' => 'required|string',
                'tipe_tiang_listrik' => 'required|in:Baja,Beton',
                'jenis_tiang' => 'required|string',
                'no_serial' => 'required|numeric',
                'pengujian_visual' => 'required|string',
                'pengujian_panjang' => 'required|string',
                'kelurusan_tiang' => 'required|string',
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

            // Tambahkan validasi kustom untuk pengujian_panjang
            $validator->sometimes('pengujian_panjang', [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $jenisTiang = $request->input('jenis_tiang');
                    $allowedLengths = [
                        '9/100' => [9],
                        '9/200' => [9],
                        '9/350' => [9],
                        '11/200' => [11],
                        '11/350' => [11],
                        '11/500' => [11],
                        '12/200' => [12],
                        '12/350' => [12],
                        '12/500' => [12],
                        '12/800' => [12],
                        '12/1200' => [12],
                        '13/200' => [13],
                        '13/350' => [13],
                        '13/500' => [13],
                        '13/800' => [13],
                        '13/1200' => [13],
                        '14/200' => [14],
                        '14/350' => [14],
                        '14/500' => [14],
                        '14/800' => [14],
                        '14/1200' => [14]
                    ];
                    // Jika nilai tidak ada dalam mapping, izinkan input manual
                    if (!in_array($value, $allowedLengths[$jenisTiang] ?? [])) {
                        // Catat input manual ke log
                        Log::warning("Input manual untuk pengujian_panjang.", [
                            'jenis_tiang' => $jenisTiang,
                            'pengujian_panjang' => $value,
                            'user_id' => auth()->id(),
                        ]);
                    }
                },
            ], function ($input) {
                // Hanya jalankan validasi ini jika jenis_tiang ada dalam mapping
                $allowedJenisTiang = [
                    '9/100',
                    '9/200',
                    '9/350',
                    '11/200',
                    '11/350',
                    '11/500',
                    '12/200',
                    '12/350',
                    '12/500',
                    '12/800',
                    '12/1200',
                    '13/200',
                    '13/350',
                    '13/500',
                    '13/800',
                    '13/1200',
                    '14/200',
                    '14/350',
                    '14/500',
                    '14/800',
                    '14/1200'
                ];

                return in_array($input->jenis_tiang, $allowedJenisTiang);
            });

            // Jalankan validasi
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Tentukan nilai kesesuaian_pengujian_panjang
            $jenisTiang = $request->input('jenis_tiang');
            $pengujianPanjang = $request->input('pengujian_panjang');

            $allowedLengths = [
                '9/100',
                '9/200',
                '9/350',
                '11/200',
                '11/350',
                '11/500',
                '12/200',
                '12/350',
                '12/500',
                '12/800',
                '12/1200',
                '13/200',
                '13/350',
                '13/500',
                '13/800',
                '13/1200',
                '14/200',
                '14/350',
                '14/500',
                '14/800',
                '14/1200'
            ];

            $up3 = UP3::where('id', $request->up3_id)->where('uid_id', $request->uid_id)->first();
            $ulp = ULP::where('id', $request->ulp_id)->where('up3_id', $request->up3_id)->first();

            if (!$up3 || !$ulp) {
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!'], 400);
            }

            // Start Logika kolom Persyaratan & Kesesuaian
            $defaultKeteranganTiangListrik = [
                'keterangan_kelurusan_tiang' => ''
            ];

            $persyaratan_pengujian_visual = 'Baik';
            $persyaratan_pengujian_panjang = 'Sesuai Standar';
            $persyaratan_kelurusan_tiang = 'Baik';
            $persyaratan_kualitas_penyambungan = 'Baik';

            $kesesuaian_pengujian_visual = $request->pengujian_visual == 'Baik' ? 'yes' : 'no';
            $kesesuaian_pengujian_panjang = in_array($pengujianPanjang, $allowedLengths[$jenisTiang] ?? []) ? 'yes' : 'no';
            $kesesuaian_kelurusan_tiang = $request->kelurusan_tiang == 'Baik' ? 'yes' : 'no';
            $kesesuaian_kualitas_penyambungan = $request->kualitas_penyambungan == 'Baik' ? 'yes' : 'no';
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
                    $destinationFolder = public_path("gambar_tiang_listrik");

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

                        $gambarPaths[] = url("gambar_tiang_listrik/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $tiang_listrik = TiangListrik::create([
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'no_surat' => $nomorSurat,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'masa_pakai' => $request->masa_pakai,
                'tipe_tiang_listrik' => $request->tipe_tiang_listrik,
                'jenis_tiang' => $request->jenis_tiang,
                'no_serial' => $request->no_serial,
                'pengujian_visual' => $request->pengujian_visual,
                'persyaratan_pengujian_visual' => $persyaratan_pengujian_visual,
                'kesesuaian_pengujian_visual' => $kesesuaian_pengujian_visual,
                'pengujian_panjang' => $request->pengujian_panjang,
                'persyaratan_pengujian_panjang' => $persyaratan_pengujian_panjang,
                'kesesuaian_pengujian_panjang' => $kesesuaian_pengujian_panjang,
                'kelurusan_tiang' => $request->kelurusan_tiang,
                'persyaratan_kelurusan_tiang' => $persyaratan_kelurusan_tiang,
                'kesesuaian_kelurusan_tiang' => $kesesuaian_kelurusan_tiang,
                'keterangan_kelurusan_tiang' => $request->keterangan_kelurusan_tiang ?: $defaultKeteranganTiangListrik['keterangan_kelurusan_tiang'],
                'kualitas_penyambungan' => $request->kualitas_penyambungan,
                'persyaratan_kualitas_penyambungan' => $persyaratan_kualitas_penyambungan,
                'kesesuaian_kualitas_penyambungan' => $kesesuaian_kualitas_penyambungan,
                'kesimpulan' => $request->kesimpulan,
                'pabrikan_id' => $request->pabrikan_id,
                'gudang_id' => $request->gudang_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths),
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-tiang-listrik.create')->with('success', 'Data berhasil disimpan!');
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
        $tiang_listrik = TiangListrik::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Tiang Baja', 'Tiang Beton'];

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

        $selectedUp3Id = $tiang_listrik->up3_id;
        $selectedUlpId = $tiang_listrik->ulp_id;
        $selectedTahunProduksi = $tiang_listrik->tahun_produksi;
        $selectedPabrikanId = $tiang_listrik->pabrikan_id;
        $selectedGudang = $tiang_listrik->gudang_id;
        $gambar = json_decode($tiang_listrik->gambar, true);

        return view('form.form_tiang_listrik_edit', compact('tiang_listrik', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'tahun_produksi' => 'required|string',
                'tipe_tiang_listrik' => 'required|in:Baja,Beton',
                'jenis_tiang' => 'required|string',
                'no_serial' => 'required|numeric',
                'masa_pakai' => 'required|string',
                'pengujian_visual' => 'required|string',
                'pengujian_panjang' => 'required|string',
                'kelurusan_tiang' => 'required|string',
                'keterangan_kelurusan_tiang' => 'nullable|string|max:55',
                'kualitas_penyambungan' => 'nullable|string',
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
            $defaultKeteranganTiangListrik = [
                'keterangan_kelurusan_tiang' => ''
            ];

            // Temukan data yang akan diupdate
            $tiang_listik = TiangListrik::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $tiang_listik->getOriginal();

            // Handle gambar
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($tiang_listik->gambar) {
                    foreach (json_decode($tiang_listik->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_tiang_listik");

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

                    $gambarPaths[] = url("gambar_tiang_listrik/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganTiangListrik as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update data
            $tiang_listik->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $tiang_listik->status = 'Approved';
                $tiang_listik->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();
            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $tiang_listik->status = 'Approved';
            //     $tiang_listik->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
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
                $tiang_listik->is_edited = true;
                // Jika ada perubahan data: update updated_at
                $tiang_listik->updated_at = now();
            } elseif ($isApproving) {
                $tiang_listik->is_edited = false;
                // Jika hanya approval: jangan update updated_at
                $tiang_listik->updated_at = $oldData['updated_at'];
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
            //     $tiang_listik->updated_at = now(); // Update timestamp perubahan
            // }

            $tiang_listik->save();

            // Log success
            Log::info('Tiang Listrik updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Tiang Listrik update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Tiang Listrik', [
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
        $tiang_listik = TiangListrik::findOrFail($id);
        $tiang_listik->delete();

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

    /**
     * Selected Pabrikan for Tiang Listrik.
     */
    public function getPabrikans(Request $request)
    {
        $tipeTiang = $request->input('tipe_tiang_listrik');

        // Definisikan kategori yang ingin dicari berdasarkan tipe tiang
        $kategoriName = $tipeTiang == 'Baja' ? 'Tiang Baja' : 'Tiang Beton';

        // Ambil kategori berdasarkan nama
        $kategoriPabrikan = KategoriPabrikan::where('nama_kategori', $kategoriName)->first();

        // Ambil semua Pabrikan yang memiliki kategori tersebut
        $pabrikans = Pabrikan::whereHas('kategoriPabrikans', function ($query) use ($kategoriPabrikan) {
            $query->where('kategori_id', $kategoriPabrikan->id);
        })->get();

        return response()->json($pabrikans);
    }
}
