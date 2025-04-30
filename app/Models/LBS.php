<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LBS extends Model
{
    protected $table = 'l_b_s';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'tipe_lbs',
        'no_serial',
        'masa_pakai',
        'nameplate',
        'persyaratan_nameplate',
        'kesesuaian_nameplate',
        'penandaan_terminal',
        'persyaratan_penandaan_terminal',
        'kesesuaian_penandaan_terminal',
        'counter_lbs',
        'persyaratan_counter_lbs',
        'kesesuaian_counter_lbs',
        'bushing_lbs',
        'persyaratan_bushing_lbs',
        'kesesuaian_bushing_lbs',
        'indikator_lbs',
        'persyaratan_indikator_lbs',
        'kesesuaian_indikator_lbs',
        'rtu_lbs',
        'persyaratan_rtu_lbs',
        'kesesuaian_rtu_lbs',
        'interuptor_lbs',
        'persyaratan_interuptor_lbs',
        'kesesuaian_interuptor_lbs',
        'mekanik1_lbs',
        'persyaratan_mekanik1_lbs',
        'kesesuaian_mekanik1_lbs',
        'keteranganMekanikManual',
        'mekanik2_lbs',
        'persyaratan_mekanik2_lbs',
        'kesesuaian_mekanik2_lbs',
        'keteranganPanelKontrol',
        'elektrik_r',
        'elektrik_s',
        'elektrik_t',
        'kesesuaian_elektrik',
        'data_elektrik',
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
    
    protected $casts = [
        'gambar' => 'array',
        'data_elektrik' => 'array',
        'kesesuaian_elektrik' => 'boolean'
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
