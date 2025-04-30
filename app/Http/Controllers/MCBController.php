<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\JenisForm;
use App\Models\KategoriPabrikan;
use App\Models\MCB;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use function Pest\Laravel\json;

class MCBController extends Controller
{
    // public function generateNomorSurat()
    // {
    //     $tahun = date('Y'); // Tahun berjalan

    //     // Menghitung jumlah surat pada tahun yang sama
    //     $lastSurat = DB::table('mcbs')
    //         ->whereYear('created_at', $tahun)
    //         ->orderBy('id', 'desc')
    //         ->first();

    //     // Ambil nomor terakhir atau mulai dari 1 jika belum ada
    //     $nomorUrut = $lastSurat ? intval(substr($lastSurat->no_surat, 0, 3)) + 1 : 1;

    //     // Formatkan agar selalu 3 digit
    //     $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/MCB/$tahun";

    //     return $nomorSurat;
    // }

    public function getUlps(Request $request)
    {
        if ($request->has('up3_id')) {
            $ulps = ULP::where('up3_id', $request->up3_id)->get();
            return response()->json($ulps);
        }
        return response()->json([]);
    }

    public function approve(string $id)
    {
        $mcb = MCB::findOrFail($id);
        $mcb->status = 'Approved';
        $mcb->save();

        return redirect()->route('form-unapproved')->with('success', 'Status berhasil diubah menjadi Approved!');
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $mcbs = MCB::latest()->paginate(10);
        // return view('', compact('mcbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['MCB'];

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

        return view('form.form_mcb', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tgl_inspeksi' => 'required|date',
                'id_pelanggan' => 'required|numeric',
                'tipe_mcb' => 'required|in:1 fasa,3 fasa',
                'nilai_ampere' => 'required|numeric',
                'no_serial' => 'nullable|numeric',
                'pengujian_ketidakhapusan_penandaan' => 'required|string',
                'pengujian_toggle_switch' => 'required|string',
                'pengujian_keandalan_sekrup' => 'required|string',
                'pengujian_keandalan_terminal'  => 'required|string',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp',
                'jenis_form_id' => 'required|exists:jenis_forms,id',
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
            $defaultKeteranganMCB = [
                'keterangan_ketidakhapusan_penandaan' => '',
                'keterangan_toggle_switch' => '',
                'keterangan_pengujian_keandalan' => "Pengujian dapat dilakukan
                bersamaan dengan memutar
                sekrup",
                'keterangan_pemutusan_arus' => ''
            ];

            $persyaratan_ketidakhapusan_penandaan = 'Baik';
            $kesesuaian_ketidakhapusan_penandaan = $request->pengujian_ketidakhapusan_penandaan == 'Baik' ? 'yes' : 'no';

            $persyaratan_toggle_switch = 'Baik';
            $kesesuaian_toggle_switch = $request->pengujian_toggle_switch == 'Baik' ? 'yes' : 'no';

            $persyaratan_keandalan_skrup = 'Baik';
            $kesesuaian_keandalan_skrup = $request->pengujian_keandalaan_sekrup == 'Baik' ? 'yes' : 'no';

            $persyaratan_pengujian_keandalan_terminal = 'Baik';
            $kesesuaian_pengujian_keandalan_terminal = $request->pengujian_keandalan_terminal == 'Baik' ? 'yes' : 'no';

            $persyaratan_pengujian_pemutusan_arus = 5;
            $kesesuaian_pengujian_pemutusan_arus = $request->pengujian_pemutusan_arus <= 5 ? 'yes' : 'no';
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
                    $destinationFolder = public_path("gambar_mcb");

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

                        $gambarPaths[] = url("gambar_mcb/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $mcb = MCB::create([
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'no_surat' => $nomorSurat,
                'id_pelanggan' => $request->id_pelanggan,
                'tipe_mcb' => $request->tipe_mcb,
                'nilai_ampere' => $request->nilai_ampere,
                'no_serial' => $request->no_serial,
                'pengujian_ketidakhapusan_penandaan' => $request->pengujian_ketidakhapusan_penandaan,
                'persyaratan_ketidakhapusan_penandaan' => $persyaratan_ketidakhapusan_penandaan,
                'kesesuaian_ketidakhapusan_penandaan' => $kesesuaian_ketidakhapusan_penandaan,
                'keterangan_ketidakhapusan_penandaan' => $request->keterangan_ketidakhapusan_penandaan ?: $defaultKeteranganMCB['keterangan_ketidakhapusan_penandaan'],

                'pengujian_toggle_switch' => $request->pengujian_toggle_switch,
                'persyaratan_toggle_switch' => $persyaratan_toggle_switch,
                'kesesuaian_toggle_switch' => $kesesuaian_toggle_switch,
                'keterangan_toggle_switch' => $request->keterangan_toggle_switch ?: $defaultKeteranganMCB['keterangan_toggle_switch'],

                'pengujian_keandalan_sekrup' => $request->pengujian_keandalan_sekrup,
                'persyaratan_keandalan_sekrup' => $persyaratan_keandalan_skrup,
                'kesesuaian_keandalan_sekrup' => $kesesuaian_keandalan_skrup,

                'pengujian_keandalan_terminal'  => $request->pengujian_keandalan_terminal,
                'persyaratan_keandalan_terminal'  => $persyaratan_pengujian_keandalan_terminal,
                'kesesuaian_keandalan_terminal'  => $kesesuaian_pengujian_keandalan_terminal,

                'keterangan_pengujian_keandalan' => $request->keterangan_pengujian_keandalan ?: $defaultKeteranganMCB['keterangan_pengujian_keandalan'],

                'pengujian_pemutusan_arus' => $request->pengujian_pemutusan_arus,
                'persyaratan_pemutusan_arus' => $persyaratan_pengujian_pemutusan_arus,
                'kesesuaian_pemutusan_arus' => $kesesuaian_pengujian_pemutusan_arus,
                'keterangan_pemutusan_arus' => $request->keterangan_pemutusan_arus ?: $defaultKeteranganMCB['keterangan_pemutusan_arus'],

                'kesimpulan' => $request->kesimpulan,
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths),
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-mcb.create')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // Get data by Id
        $mcb = MCB::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['MCB'];

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

        return view('form.form_mcb', compact('mcb', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['MCB'];

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

        $mcb = MCB::findOrFail($id);
        $selectedUp3Id = $mcb->up3_id;
        $selectedUlpId = $mcb->ulp_id;
        $selectedPabrikanId = $mcb->pabrikan_id;
        $selectedGudang = $mcb->gudang_id;

        $gambar = json_decode($mcb->gambar, true);

        return view('form.form_mcb_edit', compact('mcb', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'id_pelanggan' => 'required|numeric',
                'tipe_mcb' => 'required|in:1 fasa,3 fasa',
                'nilai_ampere' => 'required|numeric',
                'no_serial' => 'nullable|numeric',
                'pengujian_ketidakhapusan_penandaan' => 'required|string',
                'keterangan_ketidakhapusan_penandaan' => 'nullable|string|max:55',
                'pengujian_toggle_switch' => 'required|string',
                'keterangan_toggle_switch' => 'nullable|string|max:55',
                'pengujian_keandalan_sekrup' => 'required|string',
                'pengujian_keandalan_terminal'  => 'required|string',
                'pengujian_pemutusan_arus' => 'nullable|numeric',
                'keterangan_pemutusan_arus' => 'nullable|string|max:55',
                'keterangan_pengujian_keandalan' => 'nullable|string|max:55',
                'kesimpulan' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'nullable|mimes:png,jpg,jpeg,webp',
                'jenis_form_id' => 'required|exists:jenis_forms,id',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
                'status' => 'sometimes|string', // Tambahkan validasi untuk status
            ]);

            $defaultKeteranganMCB = [
                'keterangan_ketidakhapusan_penandaan' => '',
                'keterangan_toggle_switch' => '',
                'keterangan_pengujian_keandalan' => "Pengujian dapat dilakukan
                bersamaan dengan memutar
                sekrup",
                'keterangan_pemutusan_arus' => ''
            ];

            // Find the record or fail with 404
            $mcb = MCB::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $mcb->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($mcb->gambar) {
                    foreach (json_decode($mcb->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_mcb");

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

                    $gambarPaths[] = url("gambar_mcb/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganMCB as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $mcb->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $mcb->status = 'Approved';
                $mcb->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();

            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $mcb->status = 'Approved';
            //     $mcb->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
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
                $mcb->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $mcb->updated_at = $oldData['updated_at'];
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
            //     $mcb->updated_at = now(); // Update timestamp perubahan
            // }

            $mcb->save();

            // Log success
            Log::info('MCB updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during MCB update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating MCB', [
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
        $mcb = MCB::findOrFail($id);
        $mcb->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
