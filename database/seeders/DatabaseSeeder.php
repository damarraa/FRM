<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UIDSeeder::class,
            UP3Seeder::class,
            ULPSeeder::class,
            PabrikanSeeder::class,
            KategoriPabrikan::class,
            PabrikanKategori::class,
            RoleAndPermissionSeeder::class,
            KelasPengujianSeeder::class,
            GudangSeeder::class,
            JenisFormSeeder::class,
            UserSeeder::class
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
