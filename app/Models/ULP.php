<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ULP extends Model
{

    protected $table = 'ulps';

    protected $fillable = [
        'daerah',
        'up3_id'
    ];

    public function up3(): BelongsTo
    {
        return $this->belongsTo(UP3::class, 'up3_id');
    }

    // public function returKwhMeters(): HasMany
    // {
    //     return $this->hasMany(Retur_KWH_Meter::class, 'ulp_id');
    // }
}
