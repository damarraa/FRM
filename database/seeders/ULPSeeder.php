<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ULPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ulps = [
            ['id' => 1, 'up3_id' => 1, 'daerah' => 'ULP Bangkinang'],
            ['id' => 2, 'up3_id' => 1, 'daerah' => 'ULP Kampar'],
            ['id' => 3, 'up3_id' => 1, 'daerah' => 'ULP Lipat Kain'],
            ['id' => 4, 'up3_id' => 1, 'daerah' => 'ULP Pasir Pangaraian'],
            ['id' => 5, 'up3_id' => 1, 'daerah' => 'ULP Ujung Batu'],

            ['id' => 6, 'up3_id' => 2, 'daerah' => 'ULP Bagan Batu'],
            ['id' => 7, 'up3_id' => 2, 'daerah' => 'ULP Bagan Siapi Api'],
            ['id' => 8, 'up3_id' => 2, 'daerah' => 'ULP Bengkalis'],
            ['id' => 9, 'up3_id' => 2, 'daerah' => 'ULP Dumai Kota'],
            ['id' => 10, 'up3_id' => 2, 'daerah' => 'ULP Duri'],
            ['id' => 11, 'up3_id' => 2, 'daerah' => 'ULP Selat Panjang'],

            ['id' => 12, 'up3_id' => 3, 'daerah' => 'ULP Panam'],
            ['id' => 13, 'up3_id' => 3, 'daerah' => 'ULP Pangkalan Kerinci'],
            ['id' => 14, 'up3_id' => 3, 'daerah' => 'ULP Pekanbaru Kota Barat'],
            ['id' => 15, 'up3_id' => 3, 'daerah' => 'ULP Pekanbaru Kota Timur'],
            ['id' => 16, 'up3_id' => 3, 'daerah' => 'ULP Perawang'],
            ['id' => 17, 'up3_id' => 3, 'daerah' => 'ULP Rumbai'],
            ['id' => 18, 'up3_id' => 3, 'daerah' => 'ULP Siak Sri Indrapura'],
            ['id' => 19, 'up3_id' => 3, 'daerah' => 'ULP Simpang Tiga'],

            ['id' => 20, 'up3_id' => 4, 'daerah' => 'ULP Air Molek'],
            ['id' => 21, 'up3_id' => 4, 'daerah' => 'ULP Kuala Enok'],
            ['id' => 22, 'up3_id' => 4, 'daerah' => 'ULP Rengat Kota'],
            ['id' => 23, 'up3_id' => 4, 'daerah' => 'ULP Tembilahan'],
            ['id' => 24, 'up3_id' => 4, 'daerah' => 'ULP Teluk Kuantan'],

            ['id' => 25, 'up3_id' => 5, 'daerah' => 'ULP Belakang Padang'],
            ['id' => 26, 'up3_id' => 5, 'daerah' => 'ULP Bintan Center'],
            ['id' => 27, 'up3_id' => 5, 'daerah' => 'ULP Dabo Singkep'],
            ['id' => 28, 'up3_id' => 5, 'daerah' => 'ULP Kijang'],
            ['id' => 29, 'up3_id' => 5, 'daerah' => 'ULP Tanjung Balai Karimun'],
            ['id' => 30, 'up3_id' => 5, 'daerah' => 'ULP Tanjung Batu'],
            ['id' => 31, 'up3_id' => 5, 'daerah' => 'ULP Tanjung Pinang Kota'],
            ['id' => 32, 'up3_id' => 5, 'daerah' => 'ULP Tanjung Uban'],
            ['id' => 33, 'up3_id' => 5, 'daerah' => 'ULP Natuna'],
            ['id' => 34, 'up3_id' => 5, 'daerah' => 'ULP Anambas'],
        ];

        DB::table('ulps')->insert($ulps);
    }
}
