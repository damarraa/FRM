<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriPabrikan extends Model
{
    protected $fillable = [
        'nama_kategori'
    ];

    // public function pabrikans(): BelongsToMany
    // {
    //     return $this->belongsToMany(Pabrikan::class, 'pabrikan_kategori');
    // }

    public function pabrikans(): BelongsToMany
    {
        return $this->belongsToMany(Pabrikan::class, 'pabrikan_kategoris', 'kategori_id', 'pabrikan_id');
    }
}
