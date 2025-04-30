<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UP3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $up3s = [
            ['id' => 1, 'uid_id' => 1, 'unit' => 'UP3 Bangkinang', 'kode_unit' => '15'],
            ['id' => 2, 'uid_id' => 1, 'unit' => 'UP3 Dumai', 'kode_unit' => '12'],
            ['id' => 3, 'uid_id' => 1, 'unit' => 'UP3 Pekanbaru', 'kode_unit' => '11'],
            ['id' => 4, 'uid_id' => 1, 'unit' => 'UP3 Rengat', 'kode_unit' => '14'],
            ['id' => 5, 'uid_id' => 1, 'unit' => 'UP3 Tanjung Pinang', 'kode_unit' => '13'],
        ];

        DB::table('up3s')->insert($up3s);
    }
}
