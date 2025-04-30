<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CablePower extends Model
{
    protected $table = 'cable_powers';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_pemasangan',
        'jenis_cable_power',
        'ukuran_cable_power',
        'luas_penampang',
        'panjang_cable_power',
        'nilai_pemeriksaan_kondisi_visual',
        'satuan_pemeriksaan_kondisi_visual',
        'persyaratan_pemeriksaan_kondisi_visual',
        'kesesuaian_pemeriksaan_kondisi_visual',
        'keterangan_pemeriksaan',
        'nilai_pengujian_dimensi',
        'satuan_pengujian_dimensi',
        'persyaratan_pengujian_dimensi',
        'kesesuaian_pengujian_dimensi',
        'keterangan_pengujian_dimensi',
        'nilai_uji_tahanan_isolasi',
        'satuan_uji_tahanan_isolasi',
        'persyaratan_uji_tahanan_isolasi',
        'kesesuaian_uji_tahanan_isolasi',
        'keterangan_uji_tahanan_isolasi',
        'kesimpulan_k6',
        'kesimpulan_k8',
        'gambar',
        'status',
        'jenis_form_id',
        'gudang_id',
        'uid_id',
        'ulp_id',
        'up3_id',
        'user_id',
        'approved_by'
    ];

    protected $cast = [
        'gambar' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    public function pabrikan(): BelongsTo
    {
        return $this->belongsTo(Pabrikan::class, 'pabrikan_id');
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
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
