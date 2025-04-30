<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelasPengujian extends Model
{
    use HasFactory;

    protected $table = 'kelas_pengujians';
    protected $fillable = ['kelas_pengujian', 'batas_kesalahan'];

    public function kwhMeters(): HasMany
    {
        return $this->hasMany(KwhMeter::class, 'kelas_pengujian_id', 'id');
    }
}
