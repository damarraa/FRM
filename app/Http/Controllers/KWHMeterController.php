<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\JenisForm;
use App\Models\KategoriPabrikan;
use App\Models\KelasPengujian;
use App\Models\KWHMeter;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class KWHMeterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $KWHMeters = KWHMeter::latest()->paginate(10);
        // return view('', compact('KWHMeters'));
    }

    public function approve(string $id)
    {
        $kWh_Meter = KWHMeter::findOrFail($id);
        $kWh_Meter->status = 'Approved';
        $kWh_Meter->save();

        return redirect()->route('form-unapproved')->with('success', 'Status berhasil diubah menjadi Approved!');
    }


    // public function generateNomorSurat()
    // {
    //     $tahun = date('Y'); // Tahun berjalan

    //     // Menghitung jumlah surat pada tahun yang sama
    //     $lastSurat = DB::table('kwh_meters')
    //         ->whereYear('created_at', $tahun)
    //         ->orderBy('id', 'desc')
    //         ->first();

    //     // Ambil nomor terakhir atau mulai dari 1 jika belum ada
    //     $nomorUrut = $lastSurat ? intval(substr($lastSurat->no_surat, 0, 3)) + 1 : 1;

    //     // Formatkan agar selalu 3 digit
    //     $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/KWH/$tahun";

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

    public function getGudangs(Request $request)
    {
        if ($request->has('up3_id')) {
            $gudangs = Gudang::where('up3_id', $request->up3_id)->get();
            return response()->json($gudangs);
        }
        return response()->json([]);
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
            $validator = Validator::make($request->all(), [
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
                'gambar' => 'nullable|array|max:4', // Maks 4 gambar
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192', // Wajib setiap gambar ada
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                // 'jenis_form_id' => 'required|exists:jenis_forms,id',
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
                return response()->json(['error' => 'Data UP3 atau ULP tidak sesuai dengan UID yang dipilih!'], 400);
            }

            // Generate nomor surat
            // $jenisForm = JenisForm::findOrFail($request->jenis_form_id);
            // $nomorSurat = $this->generateNomorSurat();

            $persyaratan_masa_pakai = 5;
            $kesesuaian_masa_pakai = $request->masa_pakai < 5 ? 'yes' : 'no';
            $keterangan_masa_pakai = "";

            $persyaratan_body_kwh_meter = 'Baik';
            $kesesuaian_body_kwh_meter = $request->kondisi_body_kwh_meter == 'Baik' ? 'yes' : 'no';
            $keterangan_body_kwh_meter = "termasuk kaca depan meter";

            $persyaratan_segel_meterologi = 'Baik';
            $kesesuaian_segel_meterologi = $request->kondisi_segel_meterologi == 'Baik' ? 'yes' : 'no';
            $keterangan_segel_meterologi = "";

            $persyaratan_terminal = 'Baik';
            $kesesuaian_terminal = $request->kondisi_terminal == 'Baik' ? 'yes' : 'no';
            $keterangan_terminal = "";

            $persyaratan_stand_kwh_meter = 'Baik';
            $kesesuaian_stand_kwh_meter = $request->kondisi_stand_kwh_meter == 'Baik' ? 'yes' : 'no';
            $keterangan_stand_kwh_meter = "";

            $persyaratan_cover_terminal_kwh_meter = 'Baik';
            $kesesuaian_cover_terminal_kwh_meter = $request->kondisi_cover_terminal_kwh_meter == 'Baik' ? 'yes' : 'no';
            $keterangan_cover_terminal_kwh_meter = "tutup terminal dan MCB";

            $persyaratan_nameplate = 'Baik';
            $kesesuaian_nameplate = $request->kondisi_nameplate == 'Baik' ? 'yes' : 'no';
            $keterangan_nameplate = "";

            $persyaratan_uji_kesalahan = 'Sesuai kelas';
            $satuan_uji_kesalahan = "%";
            // $kelasPengujian = KelasPengujian::where('kelas_pengujian', $request->kelas_pengujian)->first();
            // if (!$kelasPengujian) {
            //     return response()->json(['error' => 'Kelas pengujian tidak ditemukan di database'], 400);
            // }
            // $kesesuaian_uji_kesalahan = abs($request->nilai_uji_kesalahan) <= $kelasPengujian->batas_kesalahan ? 'yes' : 'no';
            $keterangan_uji_kesalahan = "";

            // Generate nomor surat
            $nomorSurat = NomorSurat::generateNomorSurat(
                $request->jenis_form_id,
                $request->up3_id,
                $request->gudang_id,
                $request->tgl_inspeksi
            );

            // Versi kompresi
            // Simpan gambar dengan kompresi menggunakan GD Library
            $gambarPaths = [];

            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $filename = Str::random(20) . '.jpg';
                    $destinationPath = storage_path("app/public/gambar_kwh/{$filename}"); // Pastikan ini ke "public"

                    // Baca gambar berdasarkan tipe
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
                        // Resize gambar (lebar 1080px, tinggi mengikuti aspek rasio)
                        $width = imagesx($image);
                        $height = imagesy($image);
                        $newWidth = 1080;
                        $newHeight = ($newWidth / $width) * $height;

                        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        // Simpan gambar sebagai JPEG dengan kualitas 60%
                        imagejpeg($resizedImage, $destinationPath, 60);

                        // Bebaskan memori
                        imagedestroy($image);
                        imagedestroy($resizedImage);

                        // Simpan path yang bisa diakses oleh frontend
                        $gambarPaths[] = "storage/gambar_kwh/{$filename}";
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
                'keterangan_masa_pakai' => $keterangan_masa_pakai,
                'kondisi_body_kwh_meter' => $request->kondisi_body_kwh_meter,
                'persyaratan_body_kwh_meter' => $persyaratan_body_kwh_meter,
                'kesesuaian_body_kwh_meter' => $kesesuaian_body_kwh_meter,
                'keterangan_body_kwh_meter' => $keterangan_body_kwh_meter,
                'kondisi_segel_meterologi' => $request->kondisi_segel_meterologi,
                'persyaratan_segel_meterologi' => $persyaratan_segel_meterologi,
                'kesesuaian_segel_meterologi' => $kesesuaian_segel_meterologi,
                'keterangan_segel_meterologi' => $keterangan_segel_meterologi,
                'kondisi_terminal' => $request->kondisi_terminal,
                'persyaratan_terminal' => $persyaratan_terminal,
                'kesesuaian_terminal' => $kesesuaian_terminal,
                'keterangan_terminal' => $keterangan_terminal,
                'kondisi_stand_kwh_meter' => $request->kondisi_stand_kwh_meter,
                'persyaratan_stand_kwh_meter' => $persyaratan_stand_kwh_meter,
                'kesesuaian_stand_kwh_meter' => $kesesuaian_stand_kwh_meter,
                'keterangan_stand_kwh_meter' => $keterangan_stand_kwh_meter,
                'kondisi_cover_terminal_kwh_meter' => $request->kondisi_cover_terminal_kwh_meter,
                'persyaratan_cover_terminal_kwh_meter' => $persyaratan_cover_terminal_kwh_meter,
                'kesesuaian_cover_terminal_kwh_meter' => $kesesuaian_cover_terminal_kwh_meter,
                'keterangan_cover_terminal_kwh_meter' => $keterangan_cover_terminal_kwh_meter,
                'kondisi_nameplate' => $request->kondisi_nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'kesesuaian_nameplate' => $kesesuaian_nameplate,
                'keterangan_nameplate' => $keterangan_nameplate,
                'nilai_uji_kesalahan' => $request->nilai_uji_kesalahan,
                'satuan_uji_kesalahan' => $satuan_uji_kesalahan,
                'persyaratan_uji_kesalahan' => $persyaratan_uji_kesalahan,
                'kelas_pengujian_id' => $request->kelas_pengujian_id, // mendefenisikan kelas_pengujian_id
                // 'kesesuaian_uji_kesalahan' => $kesesuaian_uji_kesalahan,
                'keterangan_uji_kesalahan' => $keterangan_uji_kesalahan,
                'kesimpulan' => $request->kesimpulan,
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'gambar' => json_encode($gambarPaths)
            ]);

            // Kirim pesan sukses dan redirect ke halaman form
            return redirect()->route('form-retur-kwh-meter')->with('success', 'Data berhasil disimpan!');
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
        $kWh_Meter = KWHMeter::findOrFail($id);

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

        // return view('form.form_kWh_meter', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
        return view('form.form_kWh_meter', compact('kWh_Meter', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    // dd(auth()->user()->getAllPermissions()->pluck('name'));

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
        $kelas_pengujians= KelasPengujian::select('id', 'kelas_pengujian')->distinct()->get();

        $kWh_Meter = KWHMeter::findOrFail($id);
        $selectedUp3Id = $kWh_Meter->up3_id;
        $selectedUlpId = $kWh_Meter->ulp_id;
        $selectedPabrikanId = $kWh_Meter->pabrikan_id;
        $selectedTahunProduksi = $kWh_Meter->tahun_produksi;
        $selectedKelasPengujianId = $kWh_Meter->kelas_pengujian_id;
        $selectedGudang = $kWh_Meter->gudang_id;

        $gambar = json_decode($kWh_Meter->gambar, true); // Decode JSON dari database

        return view('form.form_kWh_meter_edit', compact('kWh_Meter', 'uids', 'up3s', 'ulps', 'pabrikans', 'gudangs', 'kelas_pengujians', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedKelasPengujianId', 'selectedGudang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editByPIC(string $id)
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

        $gambar = json_decode($kWh_Meter->gambar, true); // Decode JSON dari database

        return view('form.form_kWh_meter_edit_pic', compact('kWh_Meter', 'uids', 'up3s', 'ulps', 'pabrikans', 'gudangs', 'kelas_pengujians', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedKelasPengujianId', 'selectedGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
            'nilai_uji_kesalahan' => 'required|numeric',
            'kelas_pengujian_id' => 'required|string|exists:kelas_pengujians,kelas_pengujian',
            'kesimpulan' => 'required|string',
            'gambar' => 'nullable|array|max:4', // Maks 4 gambar
            'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048', // Wajib setiap gambar ada
            'pabrikan_id' => 'required|exists:pabrikans,id',
            'uid_id' => 'required|exists:uids,id',
            'up3_id' => 'required|exists:up3s,id',
            'ulp_id' => 'required|exists:ulps,id',
        ]);

        $kWh_Meter = KWHMeter::findOrFail($id);

        $kWh_Meter->update($request->all());

        // return redirect()->route('form-unapproved')->with('success', 'Data berhasil disimpan!');
        return redirect()->route('form-retur-kwh-meter.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
