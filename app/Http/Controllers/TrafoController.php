<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\NomorSurat;
use App\Models\Pabrikan;
use App\Models\Trafo;
use App\Models\UID;
use App\Models\ULP;
use App\Models\UP3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TrafoController extends Controller
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
    public function create()
    {
        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Transformator Distribusi'];

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

        return view('form.form_trafo', compact('pabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
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
                'tipe_trafo' => 'required|in:Trafo Kering (Dry Type Transformer),Trafo Berisi Minyak (Oil-Immersed Transformer)',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'penandaan_terminal' => 'required|string',
                'pengaman_tekanan' => 'required|string',
                'kondisi_tangki' => 'required|string',
                'kondisi_fisik_bushing' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kerusakan_fasa' => 'nullable|array',
                'kerusakan_fasa.*' => 'nullable|string|in:R,S,T,N',
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

            $defaultKeteranganTrafo = [
                'keterangan_nameplate' => '',
                'keterangan_penandaan_terminal' => '',
                'keterangan_pengaman_tekanan' => '',
                'keterangan_kondisi_tangki' => '',
                'keterangan_kondisi_fisik_busing' => '',
                'keterangan_nilai_hv_lv' => '',
                'keterangan_nilai_hv_ground' => '',
                'keterangan_nilai_lv_ground' => '',
                'keterangan_nilai_tap1_1u_1v' => '',
                'keterangan_nilai_tap1_1v_1w' => '',
                'keterangan_nilai_tap1_1w_1u' => '',
                'keterangan_nilai_tap3_1u_1v' => '',
                'keterangan_nilai_tap3_1v_1w' => '',
                'keterangan_nilai_tap3_1w_1u' => '',
                'keterangan_nilai_tap7_1u_1v' => '',
                'keterangan_nilai_tap7_1v_1w' => '',
                'keterangan_nilai_tap7_1w_1u' => ''
            ];

            $persyaratan_nameplate = 'Ada';
            $persyaratan_penandaan_terminal = 'Ada';
            $persyaratan_pengaman_tekanan = 'Ada';
            $persyaratan_kondisi_tangki = 'Tidak ada';
            $persyaratan_kondisi_fisik_bushing = 'Tidak ada';

            $persyaratan_pengujian_tahanan_isolasi = "1Mohm/kV atau PI > 2";
            $persyaratan_rasio_belitan = "rasio:<br>
                    Yzn5<br>
                    Dyn5<br>
                    YNyn0<br>
                    toleransi<br>
                    perbedaan rasio<br>
                    ±0,5%";

            $satuan_pengujian_tahanan_isolasi = 'M Ohm';
            $satuan_rasio_belitan = '%';

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
                    $destinationFolder = public_path("gambar_trafo");

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

                        $gambarPaths[] = url("gambar_trafo/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $trafo = Trafo::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_trafo' => $request->tipe_trafo,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'nameplate' => $request->nameplate,
                'persyaratan_nameplate' => $persyaratan_nameplate,
                'keterangan_nameplate' => $request->keterangan_nameplate ?: $defaultKeteranganTrafo['keterangan_nameplate'],
                'penandaan_terminal' => $request->penandaan_terminal,
                'persyaratan_penandaan_terminal' => $persyaratan_penandaan_terminal,
                'keterangan_penandaan_terminal' => $request->keterangan_penandaan_terminal ?: $defaultKeteranganTrafo['keterangan_penandaan_terminal'],
                'pengaman_tekanan' => $request->pengaman_tekanan,
                'persyaratan_pengaman_tekanan' => $persyaratan_pengaman_tekanan,
                'keterangan_pengaman_tekanan' => $request->keterangan_pengaman_tekanan ?: $defaultKeteranganTrafo['keterangan_pengaman_tekanan'],
                'kondisi_tangki' => $request->kondisi_tangki,
                'persyaratan_kondisi_tangki' => $persyaratan_kondisi_tangki,
                'keterangan_kondisi_tangki' => $request->keterangan_kondisi_tangki ?: $defaultKeteranganTrafo['keterangan_kondisi_tangki'],
                'kondisi_fisik_bushing' => $request->kondisi_fisik_bushing,
                'persyaratan_kondisi_fisik_bushing' => $persyaratan_kondisi_fisik_bushing,
                'persyaratan_pengujian_tahanan_isolasi' => $persyaratan_pengujian_tahanan_isolasi,
                'persyaratan_rasio_belitan' => $persyaratan_rasio_belitan,
                'kerusakan_fasa' => $request->kerusakan_fasa,
                'nilai_hv_lv' => $request->nilai_hv_lv,
                'satuan_nilai_hv_lv' => $satuan_pengujian_tahanan_isolasi,
                'kesesuaian_nilai_hv_lv' => $request->has('kesesuaian_nilai_hv_lv') ? 'yes' : 'no',
                'keterangan_nilai_hv_lv' => $request->keterangan_nilai_hv_lv ?: $defaultKeteranganTrafo['keterangan_nilai_hv_lv'],
                'nilai_hv_ground' => $request->nilai_hv_ground,
                'satuan_nilai_hv_ground' => $satuan_pengujian_tahanan_isolasi,
                'kesesuaian_nilai_hv_ground' => $request->has('kesesuaian_nilai_hv_ground') ? 'yes' : 'no',
                'keterangan_nilai_hv_ground' => $request->keterangan_nilai_hv_ground ?: $defaultKeteranganTrafo['keterangan_nilai_hv_ground'],
                'nilai_lv_ground' => $request->nilai_lv_ground,
                'satuan_nilai_lv_ground' => $satuan_pengujian_tahanan_isolasi,
                'kesesuaian_nilai_lv_ground' => $request->has('kesesuaian_nilai_lv_ground') ? 'yes' : 'no',
                'keterangan_nilai_lv_ground' => $request->keterangan_nilai_lv_ground ?: $defaultKeteranganTrafo['keterangan_nilai_lv_ground'],
                'nilai_tap1_1u_1v' => $request->nilai_tap1_1u_1v,
                'satuan_nilai_tap1_1u_1v' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap1_1u_1v' => $request->has('kesesuaian_nilai_tap1_1u_1v') ? 'yes' : 'no',
                'keterangan_nilai_tap1_1u_1v' => $request->keterangan_nilai_tap1_1u_1v ?: $defaultKeteranganTrafo['keterangan_nilai_tap1_1u_1v'],
                'nilai_tap1_1v_1w' => $request->nilai_tap1_1v_1w,
                'satuan_nilai_tap1_1v_1w' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap1_1v_1w' => $request->has('kesesuaian_nilai_tap1_1v_1w') ? 'yes' : 'no',
                'keterangan_nilai_tap1_1v_1w' => $request->keterangan_nilai_tap1_1v_1w ?: $defaultKeteranganTrafo['keterangan_nilai_tap1_1v_1w'],
                'nilai_tap1_1w_1u' => $request->nilai_tap1_1w_1u,
                'satuan_nilai_tap1_1w_1u' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap1_1w_1u' => $request->has('kesesuaian_nilai_tap1_1w_1u') ? 'yes' : 'no',
                'keterangan_nilai_tap1_1w_1u' => $request->keterangan_nilai_tap1_1w_1u ?: $defaultKeteranganTrafo['keterangan_nilai_tap1_1w_1u'],
                'nilai_tap3_1u_1v' => $request->nilai_tap3_1u_1v,
                'satuan_nilai_tap3_1u_1v' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap3_1u_1v' => $request->has('kesesuaian_nilai_tap3_1u_1v') ? 'yes' : 'no',
                'keterangan_nilai_tap3_1u_1v' => $request->keterangan_nilai_tap3_1u_1v ?: $defaultKeteranganTrafo['keterangan_nilai_tap3_1u_1v'],
                'nilai_tap3_1v_1w' => $request->nilai_tap3_1v_1w,
                'satuan_nilai_tap3_1v_1w' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap3_1v_1w' => $request->has('kesesuaian_nilai_tap3_1v_1w') ? 'yes' : 'no',
                'keterangan_nilai_tap3_1v_1w' => $request->keterangan_nilai_tap3_1v_1w ?: $defaultKeteranganTrafo['keterangan_nilai_tap3_1v_1w'],
                'nilai_tap3_1w_1u' => $request->nilai_tap3_1w_1u,
                'satuan_nilai_tap3_1w_1u' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap3_1w_1u' => $request->has('kesesuaian_nilai_tap3_1w_1u') ? 'yes' : 'no',
                'keterangan_nilai_tap3_1w_1u' => $request->keterangan_nilai_tap3_1w_1u ?: $defaultKeteranganTrafo['keterangan_nilai_tap3_1w_1u'],
                'nilai_tap7_1u_1v' => $request->nilai_tap7_1u_1v,
                'satuan_nilai_tap7_1u_1v' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap7_1u_1v' => $request->has('kesesuaian_nilai_tap7_1u_1v') ? 'yes' : 'no',
                'keterangan_nilai_tap7_1u_1v' => $request->keterangan_nilai_tap7_1u_1v ?: $defaultKeteranganTrafo['keterangan_nilai_tap7_1u_1v'],
                'nilai_tap7_1v_1w' => $request->nilai_tap7_1v_1w,
                'satuan_nilai_tap7_1v_1w' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap7_1v_1w' => $request->has('kesesuaian_nilai_tap7_1v_1w') ? 'yes' : 'no',
                'keterangan_nilai_tap7_1v_1w' => $request->keterangan_nilai_tap7_1v_1w ?: $defaultKeteranganTrafo['keterangan_nilai_tap7_1v_1w'],
                'nilai_tap7_1w_1u' => $request->nilai_tap7_1w_1u,
                'satuan_nilai_tap7_1w_1u' => $satuan_rasio_belitan,
                'kesesuaian_nilai_tap7_1w_1u' => $request->has('kesesuaian_nilai_tap7_1w_1u') ? 'yes' : 'no',
                'keterangan_nilai_tap7_1w_1u' => $request->keterangan_nilai_tap7_1w_1u ?: $defaultKeteranganTrafo['keterangan_nilai_tap7_1w_1u'],
                'kerusakan_fasa' => json_encode($request->kerusakan_fasa),
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-trafo.create')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get data by Id
        $trafo = Trafo::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Transformator Distribusi'];

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

        $selectedUp3Id = $trafo->up3_id;
        $selectedUlpId = $trafo->ulp_id;
        $selectedPabrikanId = $trafo->pabrikan_id;
        $selectedTahunProduksi = $trafo->tahun_produksi;
        $selectedGudang = $trafo->gudang_id;
        $gambar = json_decode($trafo->gambar, true);
        $kerusakan_terpilih = json_decode($trafo->kerusakan_fasa, true) ?? []; // Jika JSON
        // Jika string: $kerusakan_terpilih = explode(',', $data->kerusakan_fasa);
        return view('form.form_trafo', compact('trafo', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang', 'kerusakan_terpilih'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get data by Id
        $trafo = Trafo::findOrFail($id);

        // Definisikan kategori yang ingin dicari
        $kategoriNames = ['Transformator Distribusi'];

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

        $selectedUp3Id = $trafo->up3_id;
        $selectedUlpId = $trafo->ulp_id;
        $selectedPabrikanId = $trafo->pabrikan_id;
        $selectedTahunProduksi = $trafo->tahun_produksi;
        $selectedGudang = $trafo->gudang_id;
        $gambar = json_decode($trafo->gambar, true);
        $kerusakan_terpilih = is_array($trafo->kerusakan_fasa)
            ? $trafo->kerusakan_fasa
            : json_decode($trafo->kerusakan_fasa, true);

        if (!is_array($kerusakan_terpilih)) {
            $kerusakan_terpilih = [];
        }

        // $kerusakan_terpilih = $trafo->kerusakan_fasa ?? []; // Sudah berupa array, langsung gunakan
        // $kerusakan_terpilih = json_decode($trafo->kerusakan_fasa, true) ?? []; // Jika JSON
        // Jika string: $kerusakan_terpilih = explode(',', $data->kerusakan_fasa);
        return view('form.form_trafo_edit', compact('trafo', 'pabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedPabrikanId', 'selectedTahunProduksi', 'selectedGudang', 'kerusakan_terpilih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->merge([
                'kesesuaian_nilai_hv_lv' => $request->has('kesesuaian_nilai_hv_lv') ? 'yes' : 'no',
                'kesesuaian_nilai_hv_ground' => $request->has('kesesuaian_nilai_hv_ground') ? 'yes' : 'no',
                'kesesuaian_nilai_lv_ground' => $request->has('kesesuaian_nilai_lv_ground') ? 'yes' : 'no',
                'kesesuaian_nilai_tap1_1u_1v' => $request->has('kesesuaian_nilai_tap1_1u_1v') ? 'yes' : 'no',
                'kesesuaian_nilai_tap1_1v_1w' => $request->has('kesesuaian_nilai_tap1_1v_1w') ? 'yes' : 'no',
                'kesesuaian_nilai_tap1_1w_1u' => $request->has('kesesuaian_nilai_tap1_1w_1u') ? 'yes' : 'no',
                'kesesuaian_nilai_tap3_1u_1v' => $request->has('kesesuaian_nilai_tap3_1u_1v') ? 'yes' : 'no',
                'kesesuaian_nilai_tap3_1v_1w' => $request->has('kesesuaian_nilai_tap3_1v_1w') ? 'yes' : 'no',
                'kesesuaian_nilai_tap3_1w_1u' => $request->has('kesesuaian_nilai_tap3_1w_1u') ? 'yes' : 'no',
                'kesesuaian_nilai_tap7_1u_1v' => $request->has('kesesuaian_nilai_tap7_1u_1v') ? 'yes' : 'no',
                'kesesuaian_nilai_tap7_1v_1w' => $request->has('kesesuaian_nilai_tap7_1v_1w') ? 'yes' : 'no',
                'kesesuaian_nilai_tap7_1w_1u' => $request->has('kesesuaian_nilai_tap7_1w_1u') ? 'yes' : 'no'
            ]);

            $validated = $request->validate([
                'tgl_inspeksi' => 'required|date',
                'lokasi_akhir_terpasang' => 'required|string',
                'tipe_trafo' => 'required|in:Trafo Kering (Dry Type Transformer),Trafo Berisi Minyak (Oil-Immersed Transformer)',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'keterangan_nameplate' => 'nullable|string|max:55',
                'penandaan_terminal' => 'required|string',
                'keterangan_penandaan_terminal' => 'nullable|string|max:55',
                'pengaman_tekanan' => 'required|string',
                'keterangan_pengaman_tekanan' => 'nullable|string|max:55',
                'kondisi_tangki' => 'required|string',
                'keterangan_kondisi_tangki' => 'nullable|string|max:55',
                'kondisi_fisik_bushing' => 'required|string',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:8192',
                'kerusakan_fasa' => 'nullable|array',
                'kerusakan_fasa.*' => 'nullable|string',
                'nilai_hv_lv' => 'nullable|numeric',
                'kesesuaian_nilai_hv_lv' => 'nullable|in:yes,no',
                'keterangan_nilai_hv_lv' => 'nullable|string|max:55',
                'nilai_hv_ground' => 'nullable|numeric',
                'kesesuaian_nilai_hv_ground' => 'nullable|in:yes,no',
                'keterangan_nilai_hv_ground' => 'nullable|string|max:55',
                'nilai_lv_ground' => 'nullable|numeric',
                'kesesuaian_nilai_lv_ground' => 'nullable|in:yes,no',
                'keterangan_nilai_lv_ground' => 'nullable|string|max:55',
                'nilai_tap1_1u_1v' => 'nullable|numeric',
                'kesesuaian_nilai_tap1_1u_1v' => 'nullable|in:yes,no',
                'keterangan_nilai_tap1_1u_1v' => 'nullable|string|max:55',
                'nilai_tap1_1v_1w' => 'nullable|numeric',
                'kesesuaian_nilai_tap1_1v_1w' => 'nullable|in:yes,no',
                'keterangan_nilai_tap1_1v_1w' => 'nullable|string|max:55',
                'nilai_tap1_1w_1u' => 'nullable|numeric',
                'kesesuaian_nilai_tap1_1w_1u' => 'nullable|in:yes,no',
                'keterangan_nilai_tap1_1w_1u' => 'nullable|string|max:55',
                'nilai_tap3_1u_1v' => 'nullable|numeric',
                'kesesuaian_nilai_tap3_1u_1v' => 'nullable|in:yes,no',
                'keterangan_nilai_tap3_1u_1v' => 'nullable|string|max:55',
                'nilai_tap3_1v_1w' => 'nullable|numeric',
                'kesesuaian_nilai_tap3_1v_1w' => 'nullable|in:yes,no',
                'keterangan_nilai_tap3_1v_1w' => 'nullable|string|max:55',
                'nilai_tap3_1w_1u' => 'nullable|numeric',
                'kesesuaian_nilai_tap3_1w_1u' => 'nullable|in:yes,no',
                'keterangan_nilai_tap3_1w_1u' => 'nullable|string|max:55',
                'nilai_tap7_1u_1v' => 'nullable|numeric',
                'kesesuaian_nilai_tap7_1u_1v' => 'nullable|in:yes,no',
                'keterangan_nilai_tap7_1u_1v' => 'nullable|string|max:55',
                'nilai_tap7_1v_1w' => 'nullable|numeric',
                'kesesuaian_nilai_tap7_1v_1w' => 'nullable|in:yes,no',
                'keterangan_nilai_tap7_1v_1w' => 'nullable|string|max:55',
                'nilai_tap7_1w_1u' => 'nullable|numeric',
                'kesesuaian_nilai_tap7_1w_1u' => 'nullable|in:yes,no',
                'keterangan_nilai_tap7_1w_1u' => 'nullable|string|max:55',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'pabrikan_id' => 'required|exists:pabrikans,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id',
                'status' => 'sometimes|string', // Tambahkan validasi untuk status
            ]);

            $defaultKeteranganTrafo = [
                'keterangan_nameplate' => '',
                'keterangan_penandaan_terminal' => '',
                'keterangan_pengaman_tekanan' => '',
                'keterangan_kondisi_tangki' => '',
                'keterangan_kondisi_fisik_busing' => '',
                'keterangan_nilai_hv_lv' => '',
                'keterangan_nilai_hv_ground' => '',
                'keterangan_nilai_lv_ground' => '',
                'keterangan_nilai_tap1_1u_1v' => '',
                'keterangan_nilai_tap1_1v_1w' => '',
                'keterangan_nilai_tap1_1w_1u' => '',
                'keterangan_nilai_tap3_1u_1v' => '',
                'keterangan_nilai_tap3_1v_1w' => '',
                'keterangan_nilai_tap3_1w_1u' => '',
                'keterangan_nilai_tap7_1u_1v' => '',
                'keterangan_nilai_tap7_1v_1w' => '',
                'keterangan_nilai_tap7_1w_1u' => ''
            ];

            // Find the record or fail with 404
            $trafo = Trafo::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $trafo->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($trafo->gambar) {
                    foreach (json_decode($trafo->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_trafo");

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

                    $gambarPaths[] = url("gambar_trafo/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganTrafo as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $trafo->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $trafo->status = 'Approved';
                $trafo->approved_by = Auth::id();
            }

            // Menambahkan perubahan status berdasarkan role
            // $user = auth()->user();

            // if ($user->hasRole(['Admin', 'PIC_Gudang'])) {
            //     $trafo->status = 'Approved';
            //     $trafo->approved_by = Auth::id(); // Simpan ID PIC_Gudang yang melakukan perubahan
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
                $trafo->updated_at = now();
            } elseif ($isApproving) {
                // Jika hanya approval: jangan update updated_at
                $trafo->updated_at = $oldData['updated_at'];
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
            //     $trafo->updated_at = now(); // Update timestamp perubahan
            // }

            // Jika hanya status yang diubah, jangan update updated_at
            // if (!$isEdited && $request->has('status')) {
            //     $trafo->timestamps = false; // Nonaktifkan timestamp otomatis
            // }

            $trafo->save();

            // Log success
            Log::info('Trafo updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Trafo update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Trafo', [
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
        $trafo = Trafo::findOrFail($id);
        $trafo->delete();

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
