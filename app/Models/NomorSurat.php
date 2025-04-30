<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NomorSurat extends Model
{
    protected $table = 'nomor_surats';

    protected $fillable = [
        'jenis_form_id',
        'kode_gudang',
        'tahun',
        'kode_material',
        'increment_number',
        'index_surat',
        'nomor_surat'
    ];

    public function jenisForm()
    {
        return $this->belongsTo(JenisForm::class);
    }

    public static function generateNomorSurat($jenis_form_id, $up3_id, $gudang_id, $tgl_inspeksi)
    {
        // Ambil kode_material dari jenis_forms berdasarkan jenis_form_id
        $jenisForm = DB::table('jenis_forms')->where('id', $jenis_form_id)->first();
        if (!$jenisForm) {
            throw new \Exception('Jenis Form tidak ditemukan.');
        }
        $kode_material = $jenisForm->kode_material;

        // Ambil kode_unit dari up3s berdasarkan up3_id
        $up3 = DB::table('up3s')->where('id', $up3_id)->first();
        if (!$up3) {
            throw new \Exception('UP3 tidak ditemukan.');
        }
        $kode_unit = $up3->kode_unit;

        // Ambil kode gudang berdasarkan ID gudang
        $kodeGudang = Gudang::where('id', $gudang_id)->value('kode_gudang');

        if (!$kodeGudang) {
            throw new \Exception("Kode gudang tidak ditemukan untuk gudang_id: $gudang_id");
        }

        // Ambil tahun dari tgl_inspeksi dalam format dua digit
        $tgl_inspeksi = date('y', strtotime($tgl_inspeksi));

        // Ambil nomor terakhir secara global (tidak bergantung pada kode_material)
        $lastSurat = self::orderBy('increment_number', 'desc')->first();
        $incrementNumber = $lastSurat ? $lastSurat->increment_number + 1 : 1;

        // Format nomor surat: kode_material (xx) + kode_unit (xx) + kode_gudang (xxxx) + tahun (xx) + index surat (00001)
        $nomorSurat = sprintf(
            "%02d%02d%04d%02d%05d",
            $kode_material,
            $kode_unit,
            $kodeGudang,
            $tgl_inspeksi,
            $incrementNumber
        );

        // Simpan ke database
        return self::create([
            'jenis_form_id' => $jenis_form_id,
            'kode_material' => $kode_material,
            'up3_id' => $up3_id,
            'kode_gudang' => $kodeGudang,
            'tahun' => $tgl_inspeksi,
            'increment_number' => $incrementNumber,
            'index_surat' => $incrementNumber,
            'nomor_surat' => $nomorSurat,
        ])->nomor_surat;

        // return self::create([
        //     'jenis_form_id' => $jenis_form_id,
        //     'up3_id' => $up3_id,
        //     'gudang_id' => $gudang_id,
        //     'tahun' => $tgl_inspeksi,
        //     'kode_material' => $kode_material,
        //     'increment_number' => $incrementNumber,
        //     'nomor_surat' => $nomorSurat,
        // ]);
    }
}
