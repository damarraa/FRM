<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UID extends Model
{
    protected $table = 'uids';
    
    protected $fillable = [
        'wilayah'
    ];

    public function up3s(): HasMany
    {
        return $this->hasMany(UP3::class, 'uid_id');
    }
}
