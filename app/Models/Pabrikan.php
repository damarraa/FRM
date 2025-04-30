<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pabrikan extends Model
{
    protected $table = 'pabrikans';
    protected $fillable = [
        'nama_pabrikan'
    ];

    // public function kategoris(): BelongsToMany
    // {
    //     return $this->belongsToMany(KategoriPabrikan::class, 'pabrikan_kategori');
    // }

    public function kategoriPabrikans(): BelongsToMany
    {
        return $this->belongsToMany(KategoriPabrikan::class, 'pabrikan_kategoris', 'pabrikan_id', 'kategori_id');
    }
}
