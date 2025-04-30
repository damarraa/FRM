<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasPengujianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kelas_pengujian' => '0.5', 'batas_kesalahan' => 0.5],
            ['kelas_pengujian' => '1', 'batas_kesalahan' => 1.0],
            ['kelas_pengujian' => '2', 'batas_kesalahan' => 2.0],
        ];

        DB::table('kelas_pengujians')->insert($data);
    }
}
