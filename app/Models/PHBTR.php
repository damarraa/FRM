<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PHBTR extends Model
{
    protected $table = 'p_h_b_t_r_s';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'tahun_produksi',
        'masa_pakai',
        'lokasi_akhir_terpasang',
        'tipe_phbtr',
        'no_serial',
        'nameplate',
        'persyaratan_nameplate',
        'keteranganNameplate',
        'busbar_penyangga',
        'persyaratan_busbar_penyangga',
        'keteranganBusbar',
        'saklar_utama',
        'persyaratan_saklar_utama',
        'keteranganSaklarUtama',
        'nh_fuse',
        'persyaratan_nh_fuse',
        'keteranganNHFuse',
        'fuse_rail',
        'persyaratan_fuse_rail',
        'keteranganFuseRail',
        'selungkup_phbtr',
        'persyaratan_selungkup_phbtr',
        'keteranganSelungkup',
        'l1_phbtr',
        'keteranganL1PHBTR',
        'l2_phbtr',
        'keteranganL2PHBTR',
        'l3_phbtr',
        'keteranganL3PHBTR',
        'nphbtr',
        'keteranganNPHBTR',
        'pengujian_mekanik1',
        'persyaratan_pengujian_mekanik1',
        'keteranganMekanik1',
        'pengujian_mekanik2',
        'persyaratan_pengujian_mekanik2',
        'keteranganMekanik2',
        'gambar',
        'gambar.*',
        'kesimpulan',
        'is_edited',
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
