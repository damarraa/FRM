<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\KategoriPabrikan;
use App\Models\KotakAPP;
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

class KotakAPPController extends Controller
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
        // Ambil daftar unik pabrikan dari tabel products
        $pabrikans = KotakAPP::select('pabrikan')
            ->whereNotNull('pabrikan')
            ->distinct()
            ->orderBy('pabrikan')
            ->pluck('pabrikan');

        $existingPabrikans = KotakAPP::select('pabrikan')
            ->distinct()
            ->orderBy('pabrikan')
            ->limit(20)
            ->pluck('pabrikan');

        // List UID
        $uids = UID::all();

        // List UP3
        $up3s = UP3::all();

        // List ULP
        $ulps = ULP::all();

        // List Gudang
        $gudangs = Gudang::all();

        return view('form.form_kotakApp', compact('pabrikans', 'existingPabrikans', 'uids', 'up3s', 'ulps', 'gudangs'));
    }

    public function getPabrikans()
    {
        // Ambil daftar unik pabrikan dari tabel products
        $pabrikans = KotakAPP::select('pabrikan')
            ->whereNotNull('pabrikan')
            ->distinct()
            ->orderBy('pabrikan')
            ->pluck('pabrikan');

        return response()->json($pabrikans);
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
                'pabrikan' => 'required|string',
                'tipe_kotak' => 'required|in:Pemasangan di Dinding,Pemasangan di Tiang',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'keteranganNameplate' => 'nullable|string|max:55',
                'kondisi_selungkup' => 'required|string',
                'keteranganSelungkup' => 'nullable|string|max:55',
                'kunci_pengaman' => 'required|string',
                'keteranganKunciPengaman' => 'nullable|string|max:55',
                'ventilasi' => 'required|string',
                'keteranganVentilasi' => 'nullable|string|max:55',
                'jendela_kaca' => 'required|string',
                'keteranganJendelaKaca' => 'nullable|string|max:55',
                'kuping_pemasang' => 'required|string',
                'keteranganKupingPemasang' => 'nullable|string|max:55',
                'seal' => 'required|string',
                'keteranganSeal' => 'nullable|string|max:55',
                'logo_peringatan' => 'required|string',
                'keteranganLogoPeringatan' => 'nullable|string|max:55',
                'kotak_kontak' => 'required|string',
                'keteranganKotakKontak' => 'nullable|string|max:55',
                'papan_montase' => 'required|string',
                'keteranganPapanMontase' => 'nullable|string|max:55',
                'rangka_jendela' => 'required|string',
                'keteranganRangkaJendela' => 'nullable|string|max:55',
                'rel_mcb' => 'required|string',
                'keteranganRelMCB' => 'nullable|string|max:55',
                'lubang_kabel' => 'required|string',
                'keteranganLubangKabel' => 'nullable|string|max:55',
                'busbar_fasa' => 'required|string',
                'keteranganBusbarFasa' => 'nullable|string|max:55',
                'busbar_netral' => 'required|string',
                'keteranganBusbarNetral' => 'nullable|string|max:55',
                'insulator_busbar' => 'required|string',
                'keteranganInsulatorBusbar' => 'nullable|string|max:55',
                'indikator_shunt' => 'required|string',
                'keteranganIndikatorShunt' => 'nullable|string|max:55',
                'saku_modem' => 'required|string',
                'keteranganSakuModem' => 'nullable|string|max:55',
                'l1_app' => 'required|string',
                'keteranganL1APP' => 'nullable|string|max:55',
                'l2_app' => 'required|string',
                'keteranganL2APP' => 'nullable|string|max:55',
                'l3_app' => 'required|string',
                'keteranganL3APP' => 'nullable|string|max:55',
                'n_app' => 'required|string',
                'keteranganNAPP' => 'nullable|string|max:55',
                'pengujian_mekanik' => 'required|string',
                'keteranganMekanik' => 'nullable|string|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                // 'pabrikan_id' => 'required|exists:pabrikans,id',
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

            $defaultKeteranganKotakAPP = [
                'keteranganNameplate' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganKunciPengaman' => ' ',
                'keteranganVentilasi' => ' ',
                'keteranganJendelaKaca' => ' ',
                'keteranganKupingPemasang' => ' ',
                'keteranganSeal' => ' ',
                'keteranganLogoPeringatan' => ' ',
                'keteranganKotakKontak' => ' ',
                'keteranganPapanMontase' => ' ',
                'keteranganRangkaJendela' => ' ',
                'keteranganRelMCB' => ' ',
                'keteranganLubangKabel' => ' ',
                'keteranganBusbarFasa' => ' ',
                'keteranganBusbarNetral' => ' ',
                'keteranganInsulatorBusbar' => ' ',
                'keteranganIndikatorShunt' => ' ',
                'keteranganSakuModem' => ' ',
                'keteranganL1APP' => ' ',
                'keteranganL2APP' => ' ',
                'keteranganL3APP' => ' ',
                'keteranganNAPP' => ' ',
                'keteranganMekanik' => ' ',
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
                    $destinationFolder = public_path("gambar_kotakApp");

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

                        $gambarPaths[] = url("gambar_kotakApp/{$filename}"); // Akses langsung tanpa storage link
                    }
                }
            }

            $formattedPabrikan = ucwords(strtolower($request->pabrikan));

            $kotak = KotakAPP::create([
                'no_surat' => $nomorSurat,
                'jenis_form_id' => $request->jenis_form_id,
                'tgl_inspeksi' => $request->tgl_inspeksi,
                'lokasi_akhir_terpasang' => $request->lokasi_akhir_terpasang,
                'pabrikan' => $formattedPabrikan,
                'tahun_produksi' => $request->tahun_produksi,
                'tipe_kotak' => $request->tipe_kotak,
                'no_serial' => $request->no_serial,
                'masa_pakai' => $request->masa_pakai ?? ($request->tahun_produksi ? (date('Y') - $request->tahun_produksi) . ' tahun' : null),
                'nameplate' => $request->nameplate,
                'keteranganNameplate' => $request->keteranganNameplate ?: $defaultKeteranganKotakAPP['keteranganNameplate'],
                'kondisi_selungkup' => $request->kondisi_selungkup,
                'keteranganSelungkup' => $request->keteranganSelungkup ?: $defaultKeteranganKotakAPP['keteranganSelungkup'],
                'kunci_pengaman' => $request->kunci_pengaman,
                'keteranganKunciPengaman' => $request->keteranganKunciPengaman ?: $defaultKeteranganKotakAPP['keteranganKunciPengaman'],
                'ventilasi' => $request->ventilasi,
                'keteranganVentilasi' => $request->keteranganVentilasi ?: $defaultKeteranganKotakAPP['keteranganVentilasi'],
                'jendela_kaca' => $request->jendela_kaca,
                'keteranganJendelaKaca' => $request->keteranganJendelaKaca ?: $defaultKeteranganKotakAPP['keteranganJendelaKaca'],
                'kuping_pemasang' => $request->kuping_pemasang,
                'keteranganKupingPemasang' => $request->keteranganKupingPemasang ?: $defaultKeteranganKotakAPP['keteranganKupingPemasang'],
                'seal' => $request->seal,
                'keteranganSeal' => $request->keteranganSeal ?: $defaultKeteranganKotakAPP['keteranganSeal'],
                'logo_peringatan' => $request->logo_peringatan,
                'keteranganLogoPeringatan' => $request->keteranganLogoPeringatan ?: $defaultKeteranganKotakAPP['keteranganLogoPeringatan'],
                'kotak_kontak' => $request->kotak_kontak,
                'keteranganKotakKontak' => $request->keteranganKotakKontak ?: $defaultKeteranganKotakAPP['keteranganKotakKontak'],
                'papan_montase' => $request->papan_montase,
                'keteranganPapanMontase' => $request->keteranganPapanMontase ?: $defaultKeteranganKotakAPP['keteranganPapanMontase'],
                'rangka_jendela' => $request->rangka_jendela,
                'keteranganRangkaJendela' => $request->keteranganRangkaJendela ?: $defaultKeteranganKotakAPP['keteranganRangkaJendela'],
                'rel_mcb' => $request->rel_mcb,
                'keteranganRelMCB' => $request->keteranganRelMCB ?: $defaultKeteranganKotakAPP['keteranganRelMCB'],
                'lubang_kabel' => $request->lubang_kabel,
                'keteranganLubangKabel' => $request->keteranganLubangKabel ?: $defaultKeteranganKotakAPP['keteranganLubangKabel'],
                'busbar_fasa' => $request->busbar_fasa,
                'keteranganBusbarFasa' => $request->keteranganBusbarFasa ?: $defaultKeteranganKotakAPP['keteranganBusbarFasa'],
                'busbar_netral' => $request->busbar_netral,
                'keteranganBusbarNetral' => $request->keteranganBusbarNetral ?: $defaultKeteranganKotakAPP['keteranganBusbarNetral'],
                'insulator_busbar' => $request->insulator_busbar,
                'keteranganInsulatorBusbar' => $request->keteranganInsulatorBusbar ?: $defaultKeteranganKotakAPP['keteranganInsulatorBusbar'],
                'indikator_shunt' => $request->indikator_shunt,
                'keteranganIndikatorShunt' => $request->keteranganIndikatorShunt ?: $defaultKeteranganKotakAPP['keteranganIndikatorShunt'],
                'saku_modem' => $request->saku_modem,
                'keteranganSakuModem' => $request->keteranganSakuModem ?: $defaultKeteranganKotakAPP['keteranganSakuModem'],
                'l1_app' => $request->l1_app,
                'keteranganL1APP' => $request->keteranganL1APP ?: $defaultKeteranganKotakAPP['keteranganL1APP'],
                'l2_app' => $request->l2_app,
                'keteranganL2APP' => $request->keteranganL2APP ?: $defaultKeteranganKotakAPP['keteranganL2APP'],
                'l3_app' => $request->l3_app,
                'keteranganL3APP' => $request->keteranganL3APP ?: $defaultKeteranganKotakAPP['keteranganL3APP'],
                'n_app' => $request->n_app,
                'keteranganNAPP' => $request->keteranganNAPP ?: $defaultKeteranganKotakAPP['keteranganNAPP'],
                'pengujian_mekanik' => $request->pengujian_mekanik,
                'keteranganMekanik' => $request->keteranganMekanik ?: $defaultKeteranganKotakAPP['keteranganMekanik'],
                'kesimpulan' => $request->kesimpulan,
                'gambar' => json_encode($gambarPaths),
                'gudang_id' => $request->gudang_id,
                // 'pabrikan_id' => $request->pabrikan_id,
                'uid_id' => $request->uid_id,
                'up3_id' => $request->up3_id,
                'ulp_id' => $request->ulp_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('form-retur-kotak-app.create')->with('success', 'Data berhasil disimpan!');
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
        $kotak = KotakAPP::findOrFail($id);

        // Ambil pabrikan yang sudah ada untuk dropdown
        $existingPabrikans = KotakAPP::select('pabrikan')
            ->whereNotNull('pabrikan')
            ->distinct()
            ->orderBy('pabrikan')
            ->pluck('pabrikan');

        // List UID
        $uids = UID::all();

        // List UP3
        $up3s = UP3::all();

        // List ULP
        $ulps = ULP::all();

        // List Gudang
        $gudangs = Gudang::all();

        $selectedUp3Id = $kotak->up3_id;
        $selectedUlpId = $kotak->ulp_id;
        $selectedTahunProduksi = $kotak->tahun_produksi;
        $selectedGudang = $kotak->gudang_id;
        $gambar = json_decode($kotak->gambar, true);

        return view('form.form_kotakApp_edit', compact('kotak', 'existingPabrikans', 'uids', 'up3s', 'ulps', 'gudangs', 'gambar', 'selectedUp3Id', 'selectedUlpId', 'selectedTahunProduksi', 'selectedGudang'));
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
                'pabrikan' => 'required|string',
                'tipe_kotak' => 'required|in:Pemasangan di Dinding, Pemasangan di Tiang',
                'tahun_produksi' => 'nullable|string',
                'no_serial' => 'required|numeric',
                'nameplate' => 'required|string',
                'keteranganNameplate' => 'nullable|string|max:55',
                'kondisi_selungkup' => 'required|string',
                'keteranganSelungkup' => 'nullable|string|max:55',
                'kunci_pengaman' => 'required|string',
                'keteranganKunciPengaman' => 'nullable|string|max:55',
                'ventilasi' => 'required|string',
                'keteranganVentilasi' => 'nullable|string|max:55',
                'jendela_kaca' => 'required|string',
                'keteranganJendelaKaca' => 'nullable|string|max:55',
                'kuping_pemasang' => 'required|string',
                'keteranganKupingPemasang' => 'nullable|string|max:55',
                'seal' => 'required|string',
                'keteranganSeal' => 'nullable|string|max:55',
                'logo_peringatan' => 'required|string',
                'keteranganLogoPeringatan' => 'nullable|string|max:55',
                'kotak_kontak' => 'required|string',
                'keteranganKotakKontak' => 'nullable|string|max:55',
                'papan_montase' => 'required|string',
                'keteranganPapanMontase' => 'nullable|string|max:55',
                'rangka_jendela' => 'required|string',
                'keteranganRangkaJendela' => 'nullable|string|max:55',
                'rel_mcb' => 'required|string',
                'keteranganRelMCB' => 'nullable|string|max:55',
                'lubang_kabel' => 'required|string',
                'keteranganLubangKabel' => 'nullable|string|max:55',
                'busbar_fasa' => 'required|string',
                'keteranganBusbarFasa' => 'nullable|string|max:55',
                'busbar_netral' => 'required|string',
                'keteranganBusbarNetral' => 'nullable|string|max:55',
                'insulator_busbar' => 'required|string',
                'keteranganInsulatorBusbar' => 'nullable|string|max:55',
                'indikator_shunt' => 'required|string',
                'keteranganIndikatorShunt' => 'nullable|string|max:55',
                'saku_modem' => 'required|string',
                'keteranganSakuModem' => 'nullable|string|max:55',
                'l1_app' => 'required|string',
                'keteranganL1APP' => 'nullable|string|max:55',
                'l2_app' => 'required|string',
                'keteranganL2APP' => 'nullable|string|max:55',
                'l3_app' => 'required|string',
                'keteranganL3APP' => 'nullable|string|max:55',
                'n_app' => 'required|string',
                'keteranganNAPP' => 'nullable|string|max:55',
                'pengujian_mekanik' => 'required|string',
                'keteranganMekanik' => 'nullable|string|max:55',
                'gambar' => 'nullable|array|max:4',
                'gambar.*' => 'required|mimes:png,jpg,jpeg,webp|max:8192',
                'kesimpulan' => 'required|string',
                'gudang_id' => 'required|exists:gudangs,id',
                'uid_id' => 'required|exists:uids,id',
                'up3_id' => 'required|exists:up3s,id',
                'ulp_id' => 'required|exists:ulps,id'
            ]);

            $defaultKeteranganKotakAPP = [
                'keteranganNameplate' => ' ',
                'keteranganSelungkup' => ' ',
                'keteranganKunciPengaman' => ' ',
                'keteranganVentilasi' => ' ',
                'keteranganJendelaKaca' => ' ',
                'keteranganKupingPemasang' => ' ',
                'keteranganSeal' => ' ',
                'keteranganLogoPeringatan' => ' ',
                'keteranganKotakKontak' => ' ',
                'keteranganPapanMontase' => ' ',
                'keteranganRangkaJendela' => ' ',
                'keteranganRelMCB' => ' ',
                'keteranganLubangKabel' => ' ',
                'keteranganBusbarFasa' => ' ',
                'keteranganBusbarNetral' => ' ',
                'keteranganInsulatorBusbar' => ' ',
                'keteranganIndikatorShunt' => ' ',
                'keteranganSakuModem' => ' ',
                'keteranganL1APP' => ' ',
                'keteranganL2APP' => ' ',
                'keteranganL3APP' => ' ',
                'keteranganNAPP' => ' ',
                'keteranganMekanik' => ' ',
            ];

            // Find the record or fail with 404
            $kotak = KotakAPP::findOrFail($id);

            // Simpan nilai lama sebelum diupdate
            $oldData = $kotak->getOriginal();

            // **Handle Gambar**
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($kotak->gambar) {
                    foreach (json_decode($kotak->gambar) as $oldImage) {
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
                    $destinationFolder = public_path("gambar_kotakApp");

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

                    $gambarPaths[] = url("gambar_kotakApp/{$filename}");
                }

                $validated['gambar'] = json_encode($gambarPaths);
            }

            // Terapkan nilai default jika field tidak diisi
            foreach ($defaultKeteranganKotakAPP as $key => $value) {
                if (empty($validated[$key])) {
                    $validated[$key] = $value;
                }
            }

            // Update the record with all validated data
            $kotak->fill($validated);

            // Menambahkan perubahan status berdasarkan role dan logika approval
            $user = auth()->user();
            $isApproving = $user->hasRole(['Admin', 'PIC_Gudang']) && $oldData['status'] != 'Approved';

            if ($isApproving) {
                $kotak->status = 'Approved';
                $kotak->approved_by = Auth::id();
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
                $kotak->is_edited = true;
                // Jika ada perubahan data: update updated_at
                $kotak->updated_at = now();
            } elseif ($isApproving) {
                $kotak->is_edited = false;
                // Jika hanya approval: jangan update updated_at
                $kotak->updated_at = $oldData['updated_at'];
            }

            $kotak->save();

            // Log success
            Log::info('Kotak App updated successfully', [
                'id' => $id,
                'changed_fields' => $changedFields,
                'is_approving' => $isApproving,
                'is_data_changed' => $isDataChanged
            ]);

            return redirect('/unapproved')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::warning('Validation failed during Kotak App update', [
                'id' => $id,
                'errors' => $e->errors()
            ]);

            // Redirect back with errors and input
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Error updating Kotak App', [
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
        $kotak = KotakAPP::findOrFail($id);
        $kotak->delete();

        return redirect()->route('form-unapproved')->with(['success' => 'Data Deleted Successfully!']);
    }
}
