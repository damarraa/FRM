<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class JenisForm extends Model
{
    protected $table = 'jenis_forms';

    protected $fillable = [
        'nama_form',
        'kode_form',
        'kode_material'
    ];

    public function nomor_surat(): HasMany
    {
        return $this->hasMany(NomorSurat::class);
    }

    public function kwh_meters(): HasMany
    {
        return $this->hasMany(KWHMeter::class, 'jenis_from_id');
    }

    public function mcbs(): HasMany
    {
        return $this->hasMany(MCB::class, 'jenis_from_id');
    }

    public function trafos(): HasMany
    {
        return $this->hasMany(Trafo::class, 'jenis_from_id');
    }
    public function cable_powers(): HasMany
    {
        return $this->hasMany(CablePower::class, 'jenis_from_id');
    }

    // public function jenis_forms(): HasMany
    // {
    //     return $this->hasMany(KWHMeter::class, 'jenis_from_id');
    // }

    // public function form(): MorphTo
    // {
    //     return $this->morphTo();
    // }
}
