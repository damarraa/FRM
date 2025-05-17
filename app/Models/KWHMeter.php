<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Stmt\Return_;

class KWHMeter extends Model
{
    protected $table = 'kwh_meters';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'id_pelanggan',
        'unit_layanan_pelanggan',
        'tahun_produksi',
        'tipe_kwh_meter',
        'no_serial',
        'masa_pakai',
        'persyaratan_masa_pakai',
        'kesesuaian_masa_pakai',
        'keterangan_masa_pakai',
        'kondisi_body_kwh_meter',
        'persyaratan_body_kwh_meter',
        'kesesuaian_body_kwh_meter',
        'keterangan_body_kwh_meter',
        'kondisi_segel_meterologi',
        'persyaratan_segel_meterologi',
        'kesesuaian_segel_meterologi',
        'keterangan_segel_meterologi',
        'kondisi_terminal',
        'persyaratan_terminal',
        'kesesuaian_terminal',
        'keterangan_terminal',
        'kondisi_stand_kwh_meter',
        'persyaratan_stand_kwh_meter',
        'kesesuaian_stand_kwh_meter',
        'keterangan_stand_kwh_meter',
        'kondisi_cover_terminal_kwh_meter',
        'persyaratan_cover_terminal_kwh_meter',
        'kesesuaian_cover_terminal_kwh_meter',
        'keterangan_cover_terminal_kwh_meter',
        'kondisi_nameplate',
        'persyaratan_nameplate',
        'kesesuaian_nameplate',
        'keterangan_nameplate',
        'nilai_uji_kesalahan',
        'satuan_uji_kesalahan',
        'persyaratan_uji_kesalahan',
        'kesesuaian_uji_kesalahan',
        'keterangan_uji_kesalahan',
        'kesimpulan',
        'gambar',
        'status',
        'is_edited',
        'jenis_form_id',
        'gudang_id',
        'kelas_pengujian_id',
        'pabrikan_id',
        'uid_id',
        'ulp_id',
        'up3_id',
        'user_id',
        'approved_by'
    ];

    protected $casts = [
        'gambar' => 'array'
    ];

    protected function setKesesuaianMasaPakaiAttribute($value)
    {
        $this->attributes['kesesuaian_masa_pakai'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianBodyKWHMeterAttribute($value)
    {
        $this->attributes['kesesuaian_body_kwh_meter'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianSegelMeterologiAttribute($value)
    {
        $this->attributes['kesesuaian_segel_meterologi'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianTerminalAttribute($value)
    {
        $this->attributes['kesesuaian_terminal'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianStandKWHMeterAttribute($value)
    {
        $this->attributes['kesesuaian_stand_kwh_meter'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianCoverTerminalKWHMeterAttribute($value)
    {
        $this->attributes['kesesuaian_cover_terminal_kwh_meter'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianNameplateAttribute($value)
    {
        $this->attributes['kesesuaian_nameplate'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianUjiKesalahanAttribute($value)
    {
        $this->attributes['kesesuaian_uji_kesalahan'] = $value ? 'yes' : 'no';
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

    public function kelasPengujian()
    {
        return $this->belongsTo(KelasPengujian::class, 'kelas_pengujian_id', 'id');
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

    // // Tambahkan di model KWHMeter
    // protected $appends = ['is_edited'];

    // public function getIsEditedAttribute()
    // {
    //     // Cek apakah updated_at lebih dari 1 detik setelah created_at
    //     return $this->updated_at->diffInSeconds($this->created_at) > 1;
    // }
}
