<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPabrikan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'KWH Meter 1'],
            ['nama_kategori' => 'MCB'],
            ['nama_kategori' => 'Power Cable'],
            ['nama_kategori' => 'Konduktor MV'],
            ['nama_kategori' => 'Transformator Distribusi'],
            ['nama_kategori' => 'Fuse Cut Out'],
            ['nama_kategori' => 'Isolator'],
            ['nama_kategori' => 'Lightning Arrester'],
            ['nama_kategori' => 'PHBTR'],
            ['nama_kategori' => 'Cubicle'],
            ['nama_kategori' => 'CT'],
            ['nama_kategori' => 'PT'],
            ['nama_kategori' => 'Load Break Switch'],
            ['nama_kategori' => 'KWH Meter 3'],
            ['nama_kategori' => 'Tiang Baja'],
            ['nama_kategori' => 'Tiang Beton'],
        ];

        DB::table('kategori_pabrikans')->insert($data);
    }
}
