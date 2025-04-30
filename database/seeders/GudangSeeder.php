<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Gudang PKU
            ['kode_gudang' => '2000', 'nama_gudang' => 'UP3 Pekanbaru', 'up3_id' => 3],
            ['kode_gudang' => '2200', 'nama_gudang' => 'ULP Pekanbaru Kota Timur', 'up3_id' => 3],
            ['kode_gudang' => '2190', 'nama_gudang' => 'ULP Pekanbaru Kota Barat', 'up3_id' => 3],
            ['kode_gudang' => '2230', 'nama_gudang' => 'ULP Simpang Tiga', 'up3_id' => 3],
            ['kode_gudang' => '2220', 'nama_gudang' => 'ULP Rumbai', 'up3_id' => 3],
            ['kode_gudang' => '2210', 'nama_gudang' => 'ULP Panam', 'up3_id' => 3],
            ['kode_gudang' => '2170', 'nama_gudang' => 'ULP Pangkalan Kerinci', 'up3_id' => 3],
            ['kode_gudang' => '2270', 'nama_gudang' => 'ULP Siak Sri Indrapura', 'up3_id' => 3],
            ['kode_gudang' => '2180', 'nama_gudang' => 'ULP Perawang', 'up3_id' => 3],
            // Gudang BKN
            ['kode_gudang' => '2530', 'nama_gudang' => 'UP3 Bangkinang', 'up3_id' => 1],
            ['kode_gudang' => '2540', 'nama_gudang' => 'ULP Bangkinang', 'up3_id' => 1],
            ['kode_gudang' => '2550', 'nama_gudang' => 'ULP Kampar', 'up3_id' => 1],
            ['kode_gudang' => '2560', 'nama_gudang' => 'ULP Lipat Kain', 'up3_id' => 1],
            ['kode_gudang' => '2570', 'nama_gudang' => 'ULP Ujung Batu', 'up3_id' => 1],
            ['kode_gudang' => '2580', 'nama_gudang' => 'ULP Pasir Pengaraian', 'up3_id' => 1],
            // Gudang Dumai
            ['kode_gudang' => '2010', 'nama_gudang' => 'UP3 Dumai', 'up3_id' => 2],
            ['kode_gudang' => '2280', 'nama_gudang' => 'ULP Dumai Kota', 'up3_id' => 2],
            ['kode_gudang' => '2290', 'nama_gudang' => 'ULP Duri', 'up3_id' => 2],
            ['kode_gudang' => '2300', 'nama_gudang' => 'ULP Bagan Siapi-api', 'up3_id' => 2],
            ['kode_gudang' => '2310', 'nama_gudang' => 'ULP Batu', 'up3_id' => 2],
            ['kode_gudang' => '2320', 'nama_gudang' => 'ULP Bengkalis', 'up3_id' => 2],
            ['kode_gudang' => '2330', 'nama_gudang' => 'ULP Selat Panjang', 'up3_id' => 2],
            // Gudang Tj Pinang
            ['kode_gudang' => '2020', 'nama_gudang' => 'UP3 Tanjung Pinang', 'up3_id' => 5],
            ['kode_gudang' => '2340', 'nama_gudang' => 'ULP Anambas', 'up3_id' => 5],
            ['kode_gudang' => '2350', 'nama_gudang' => 'ULP Natuna', 'up3_id' => 5],
            ['kode_gudang' => '2360', 'nama_gudang' => 'ULP Tanjung Pinang', 'up3_id' => 5],
            ['kode_gudang' => '2370', 'nama_gudang' => 'ULP Bintan Center', 'up3_id' => 5],
            ['kode_gudang' => '2380', 'nama_gudang' => 'ULP Kijang', 'up3_id' => 5],
            ['kode_gudang' => '2390', 'nama_gudang' => 'ULP Tanjung Uba', 'up3_id' => 5],
            ['kode_gudang' => '2400', 'nama_gudang' => 'ULP Belakang Padang', 'up3_id' => 5],
            ['kode_gudang' => '2410', 'nama_gudang' => 'ULP Tanjung Balai Karimun', 'up3_id' => 5],
            ['kode_gudang' => '2420', 'nama_gudang' => 'ULP Tanjung Batu', 'up3_id' => 5],
            ['kode_gudang' => '2430', 'nama_gudang' => 'ULP Dabo Singkep', 'up3_id' => 5],
            // Gudang Rengat
            ['kode_gudang' => '2030', 'nama_gudang' => 'UP3 Rengat', 'up3_id' => 4],
            ['kode_gudang' => '2450', 'nama_gudang' => 'ULP Rengat Kota', 'up3_id' => 4],
            ['kode_gudang' => '2460', 'nama_gudang' => 'ULP Air Molek', 'up3_id' => 4],
            ['kode_gudang' => '2470', 'nama_gudang' => 'ULP Teluk Kuantan', 'up3_id' => 4],
            ['kode_gudang' => '2480', 'nama_gudang' => 'ULP Tembilahan', 'up3_id' => 4],
            ['kode_gudang' => '2490', 'nama_gudang' => 'ULP Kuala Enok', 'up3_id' => 4],
        ];

        DB::table('gudangs')->insert($data);
    }
}
