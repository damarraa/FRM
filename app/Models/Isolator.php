<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Isolator extends Model
{
    protected $table = 'isolators';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'tipe_isolator',
        'no_serial',
        'masa_pakai',
        'kondisi_visual',
        'persyaratan_kondisi_visual',
        'kesesuaian_kondisi_visual',
        'keteranganVisualTampak',
        'kondisi_warna',
        'persyaratan_kondisi_warna',
        'kesesuaian_kondisi_warna',
        'keteranganKondisiWarna',
        'kondisi_pecah',
        'persyaratan_kondisi_pecah',
        'kesesuaian_kondisi_pecah',
        'keteranganKondisiPecah',
        'kondisi_permukaan',
        'persyaratan_kondisi_permukaan',
        'kesesuaian_kondisi_permukaan',
        'keteranganKondisiPermukaan',
        'kondisi_korosi',
        'persyaratan_kondisi_korosi',
        'kesesuaian_kondisi_korosi',
        'keteranganKondisiKorosi',
        'pengujian_isolasi',
        'persyaratan_pengujian_isolasi',
        'kesesuaian_pengujian_isolasi',
        'keteranganTahananIsolasi',
        'kesimpulan',
        'gambar',
        'is_edited',
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

    protected $casts = [
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
