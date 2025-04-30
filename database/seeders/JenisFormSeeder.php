<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_form' => 'KWH METER', 'kode_form' => 'Formulir 01-A', 'kode_material' => '01'],
            ['nama_form' => 'MCB', 'kode_form' => 'Formulir 01-B', 'kode_material' => '02'],
            ['nama_form' => 'KOTAK APP', 'kode_form' => 'Formulir 01-C', 'kode_material' => '03'],
            ['nama_form' => 'CABLE POWER', 'kode_form' => 'Formulir 01-D', 'kode_material' => '04'],
            ['nama_form' => 'KONDUKTOR', 'kode_form' => 'Formulir 01-E', 'kode_material' => '05'],
            ['nama_form' => 'TRAFO DISTRIBUSI', 'kode_form' => 'Formulir 01-F', 'kode_material' => '06'],
            ['nama_form' => 'LIGHTNING ARRESTER', 'kode_form' => 'Formulir 01-G', 'kode_material' => '07'],
            ['nama_form' => 'FUSE CUT OUT', 'kode_form' => 'Formulir 01-H', 'kode_material' => '08'],
            ['nama_form' => 'ISOLATOR', 'kode_form' => 'Formulir 01-I', 'kode_material' => '09'],
            ['nama_form' => 'PHBTM / CUBICLE', 'kode_form' => 'Formulir 01-J', 'kode_material' => '10'],
            ['nama_form' => 'PHBTR', 'kode_form' => 'Formulir 01-K', 'kode_material' => '11'],
            ['nama_form' => 'TRAFO ARUS (CT)', 'kode_form' => 'Formulir 01-L', 'kode_material' => '12'],
            ['nama_form' => 'TRAFO TEGANGAN (PT)', 'kode_form' => 'Formulir 01-M', 'kode_material' => '13'],
            ['nama_form' => 'LBS', 'kode_form' => 'Formulir 01-N', 'kode_material' => '14'],
            ['nama_form' => 'TIANG LISTRIK', 'kode_form' => 'Formulir 01-O', 'kode_material' => '15'],
        ];

        DB::table('jenis_forms')->insert($data);
    }
}
