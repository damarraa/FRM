<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuseCutOut extends Model
{
    protected $table = 'fuse_cut_outs';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'masa_pakai',
        'tipe_fco',
        'no_serial',
        'penandaan_fuse',
        'keteranganPenandaanFuse',
        'penandaan_carrier',
        'keteranganPenandaanCarrier',
        'fuse_base',
        'keteranganFuseBase',
        'fuse_carrier',
        'keteranganFuseCarrier',
        'bracket',
        'keterangan_bracket',
        'mekanisme_kontak',
        'keteranganMekanismeKontak',
        'kondisi_fuse_base',
        'keteranganKondisiFuseBase',
        'kondisi_insulator',
        'keteranganKondisiInsulator',
        'kondisi_bracket',
        'keteranganKondisiBracket',
        'kondisi_fuse_carrier',
        'keteranganKondisiFuseCarrier',
        'uji_tahanan_isolasi',
        'keterangan_uji_tahanan',
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
