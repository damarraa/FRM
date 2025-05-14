<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cubicle extends Model
{
    protected $table = 'cubicles';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'tahun_produksi',
        'masa_pakai',
        'lokasi_akhir_terpasang',
        'tipe_cubicle',
        'no_serial',
        'nameplate',
        'persyaratan_nameplate',
        'keteranganNameplate',
        'kelengkapan_peralatan',
        'persyaratan_kelengkapan_peralatan',
        'keteranganKelengkapan',
        'busbar_penyangga',
        'persyaratan_busbar_penyangga',
        'keteranganBusbar',
        'kondisi_pembumian',
        'persyaratan_kondisi_pembumian',
        'keteranganPembumian',
        'kondisi_selungkup',
        'persyaratan_kondisi_selungkup',
        'keteranganSelungkup',
        'l1_cubicle',
        'keteranganL1Cubicle',
        'l2_cubicle',
        'keteranganL2Cubicle',
        'l3_cubicle',
        'keteranganL3Cubicle',
        'n_cubicle',
        'keteranganNCubicle',
        'pengujian_mekanik1',
        'persyaratan_pengujian_mekanik1',
        'keteranganPengujianMekanik1',
        'persyaratan_pengujian_mekanik1',
        'pengujian_mekanik2',
        'persyaratan_pengujian_mekanik2',
        'keteranganPengujianMekanik2',
        'gambar',
        'gambar.*',
        'kesimpulan',
        'gudang_id',
        'jenis_form_id',
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
