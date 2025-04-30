<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrafoArus extends Model
{
    protected $table = 'trafo_aruses';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'tipe_trafo_arus',
        'no_serial',
        'rasio',
        'kelas_pengukuran',
        'kelas_proteksi',
        'masa_pakai',
        'retak_pada_resin',
        'persyaratan_retak',
        'kesesuaian_retak',
        'nameplate',
        'persyaratan_nameplate',
        'kesesuaian_nameplate',
        'penandaan_terminal',
        'persyaratan_penandaan_terminal',
        'kesesuaian_penandaan_terminal',
        'kelengkapan_baut_primer',
        'persyaratan_baut_primer',
        'kesesuaian_baut_primer',
        'kelengkapan_baut_sekunder',
        'persyaratan_baut_sekunder',
        'kesesuaian_baut_sekunder',
        'cover_terminal',
        'persyaratan_cover_terminal',
        'kesesuaian_cover_terminal',
        'nilai_pengujian_primer',
        'satuan_nilai_pengujian_primer',
        'persyaratan_nilai_pengujian_primer',
        'kesesuaian_nilai_pengujian_primer',
        'keterangan_nilai_pengujian_primer',
        'nilai_pengujian_sekunder',
        'satuan_nilai_pengujian_sekunder',
        'persyaratan_nilai_pengujian_sekunder',
        'kesesuaian_nilai_pengujian_sekunder',
        'keterangan_nilai_pengujian_sekunder',
        'batas_kesalahan',
        'satuan_batas_kesalahan',
        'persyaratan_batas_kesalahan',
        'kesesuaian_batas_kesalahan',
        'keterangan_batas_kesalahan',
        'kelas_akurasi',
        'kesimpulan',
        'gambar',
        'status',
        'jenis_form_id',
        'gudang_id',
        'pabrikan_id',
        'uid_id',
        'up3_id',
        'ulp_id',
        'user_id',
        'approved_by'
    ];

    protected $cast = [
        'gambar' => 'array'
    ];

    // Relasi user yang submit form
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi user yang approve form
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function jenisForm()
    {
        return $this->belongsTo(JenisForm::class, 'jenis_form_id');
    }

    public function nomorSurat()
    {
        return $this->hasOne(NomorSurat::class, 'jenis_form_id', 'jenis_form_id')
            ->where('kode_gudang', $this->gudang_id)
            ->whereYear('created_at', date('Y', strtotime($this->tgl_inspeksi)));
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function pabrikan(): BelongsTo
    {
        return $this->belongsTo(Pabrikan::class, 'pabrikan_id');
    }

    public function uid(): BelongsTo
    {
        return $this->belongsTo(UID::class);
    }

    public function up3s(): BelongsTo
    {
        return $this->belongsTo(UP3::class, 'up3_id');
    }

    public function ulp(): BelongsTo
    {
        return $this->belongsTo(ULP::class, 'ulp_id', 'id');
    }
}
