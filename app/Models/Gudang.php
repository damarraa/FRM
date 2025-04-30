<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gudang extends Model
{
    protected $table = 'gudangs';

    protected $fillable = [
        'kode_gudang',
        'nama_gudang'
    ];

    public function up3(): BelongsTo
    {
        return $this->belongsTo(UP3::class, 'up3_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'gudang_id');
    }
}
