<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trafo extends Model
{
    protected $table = 'trafos';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'tipe_trafo',
        'no_serial',
        'masa_pakai',
        'nameplate',
        'persyaratan_nameplate',
        'kesesuaian_nameplate',
        'keterangan_nameplate',
        'penandaan_terminal',
        'persyaratan_penandaan_terminal',
        'kesesuaian_penandaan_terminal',
        'keterangan_penandaan_terminal',
        'pengaman_tekanan',
        'persyaratan_pengaman_tekanan',
        'kesesuaian_pengaman_tekanan',
        'keterangan_pengaman_tekanan',
        'kondisi_tangki',
        'persyaratan_kondisi_tangki',
        'kesesuaian_kondisi_tangki',
        'keterangan_kondisi_tangki',
        'kondisi_fisik_bushing',
        'persyaratan_kondisi_fisik_bushing',
        'kesesuaian_kondisi_fisik_bushing',
        'keterangan_kondisi_fisik_bushing',
        'kerusakan_fasa',
        'nilai_hv_lv',
        'satuan_nilai_hv_lv',
        'kesesuaian_nilai_hv_lv',
        'keterangan_nilai_hv_lv',
        'nilai_hv_ground',
        'satuan_nilai_hv_ground',
        'kesesuaian_nilai_hv_ground',
        'keterangan_nilai_hv_ground',
        'nilai_lv_ground',
        'satuan_nilai_lv_ground',
        'kesesuaian_nilai_lv_ground',
        'keterangan_nilai_lv_ground',
        'nilai_tap1_1u_1v',
        'satuan_nilai_tap1_1u_1v',
        'kesesuaian_nilai_tap1_1u_1v',
        'keterangan_nilai_tap1_1u_1v',
        'nilai_tap1_1v_1w',
        'satuan_nilai_tap1_1v_1w',
        'kesesuaian_nilai_tap1_1v_1w',
        'keterangan_nilai_tap1_1v_1w',
        'nilai_tap1_1w_1u',
        'satuan_nilai_tap1_1w_1u',
        'kesesuaian_nilai_tap1_1w_1u',
        'keterangan_nilai_tap1_1w_1u',
        'nilai_tap3_1u_1v',
        'satuan_nilai_tap3_1u_1v',
        'kesesuaian_nilai_tap3_1u_1v',
        'keterangan_nilai_tap3_1u_1v',
        'nilai_tap3_1v_1w',
        'satuan_nilai_tap3_1v_1w',
        'kesesuaian_nilai_tap3_1v_1w',
        'keterangan_nilai_tap3_1v_1w',
        'nilai_tap3_1w_1u',
        'satuan_nilai_tap3_1w_1u',
        'kesesuaian_nilai_tap3_1w_1u',
        'keterangan_nilai_tap3_1w_1u',
        'nilai_tap7_1u_1v',
        'satuan_nilai_tap7_1u_1v',
        'kesesuaian_nilai_tap7_1u_1v',
        'keterangan_nilai_tap7_1u_1v',
        'nilai_tap7_1v_1w',
        'satuan_nilai_tap7_1v_1w',
        'kesesuaian_nilai_tap7_1v_1w',
        'keterangan_nilai_tap7_1v_1w',
        'nilai_tap7_1w_1u',
        'satuan_nilai_tap7_1w_1u',
        'kesesuaian_nilai_tap7_1w_1u',
        'keterangan_nilai_tap7_1w_1u',
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
        'approved_by',
        'persyaratan_pengujian_tahanan_isolasi',
        'persyaratan_rasio_belitan'
    ];

    protected $casts = [
        'kerusakan_fasa' => 'array',
        'gambar' => 'array'
    ];

    protected function setKesesuaianNilaiTap1UVAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap1_1u_1v'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap1VWAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap1_1v_1w'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap1WUAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap1_1w_1u'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap3UVAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap3_1u_1v'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap3VWAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap3_1v_1w'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap3WUAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap3_1w_1u'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap7UVAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap7_1w_1u'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap7VWAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap7_1w_1u'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNilaiTap7WUAttribute($value)
    {
        $this->attributes['kesesuaian_nilai_tap7_1w_1u'] = $value ? 'yes' : 'no';
    }

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
