<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UIDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uids = [
            ['wilayah' => 'Riau dan Kepulauan Riau']
        ];

        DB::table('uids')->insert($uids);
    }
}
