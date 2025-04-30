<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UP3 extends Model
{
    protected $table = 'up3s';
    protected $fillable = [
        'unit',
        'uid_id'
    ];

    public function uid(): BelongsTo
    {
        return $this->belongsTo(UID::class, 'uid_id');
    }

    public function ulps(): HasMany
    {
        return $this->hasMany(ULP::class, 'up3_id');
    }

    public function gudangs(): HasMany
    {
        return $this->hasMany(Gudang::class, 'gudang_id');
    }

    public function kwhMeters()
    {
        return $this->hasMany(KWHMeter::class, 'up3_id');
    }
}
