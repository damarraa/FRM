<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MCB extends Model
{
    protected $table = 'mcbs';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'id_pelanggan',
        'tipe_mcb',
        'nilai_ampere',
        'no_serial',
        'pengujian_ketidakhapusan_penandaan',
        'persyaratan_ketidakhapusan_penandaan',
        'kesesuaian_pengujian_ketidakhapusan_penandaan',
        'keterangan_ketidakhapusan_penandaan',
        'pengujian_toggle_switch',
        'persyaratan_toggle_switch',
        'kesesuaian_pengujian_toggle_switch',
        'keterangan_toggle_switch',
        'pengujian_keandalan_sekrup',
        'persyaratan_keandalan_sekrup',
        'kesesuaian_keandalan_sekrup',
        'pengujian_keandalan_terminal',
        'persyaratan_keandalan_terminal',
        'kesesuaian_keandalan_terminal',
        'keterangan_pengujian_keandalan',
        'pengujian_pemutusan_arus',
        'persyaratan_pemutusan_arus',
        'kesesuaian_pemutusan_arus',
        'keterangan_pemutusan_arus',
        'kesimpulan',
        'gambar',
        'status',
        'is_edited',
        'jenis_form_id',
        'gudang_id',
        'pabrikan_id',
        'uid_id',
        'ulp_id',
        'up3_id',
        'user_id',
        'approved_by'
    ];

    protected $cast = [
        'gambar' => 'array'
    ];

    protected function setKesesuaianPengujianKetidakhapusanPenandaanAttribute($value)
    {
        $this->attributes['kesesuaian_pengujian_ketidakhapusan_penandaan'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianPengujianToggleSwitchAttribute($value)
    {
        $this->attributes['kesesuaian_pengujian_toggle_switch'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianKeandalanSekrupAttribute($value)
    {
        $this->attributes['kesesuaian_keandalan_sekrup'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianKeandalanTerminalAttribute($value)
    {
        $this->attributes['kesesuaian_keandalan_terminal'] = $value ? 'yes' : 'no';
    }

    protected function setKesesuaianPemutusanArusAttribute($value)
    {
        $this->attributes['kesesuaian_pemutusan_arus'] = $value ? 'yes' : 'no';
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
