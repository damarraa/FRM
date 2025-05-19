<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan User Baru untuk Admin
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'no_hp' => '',
            'is_active' => true
        ]);

        // Assign Role Admin ke User
        $user->assignRole('Admin');

        // Tambahkan UserA Baru untuk PIC Gudang
        $userA = User::create([
            'name' => 'PIC Gudang',
            'email' => 'pic@example.com',
            'password' => Hash::make('gudang'),
            'no_hp' => '',
            'is_active' => true
        ]);

        // Assign Role PIC Gudang ke UserA
        $userA->assignRole('PIC_Gudang');

        // Tambahkan UserB Baru untuk Petugas
        $userB = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('petugas'),
            'no_hp' => '',
            'is_active' => true
        ]);

        // Assign Role Petugas ke UserB
        $userB->assignRole('Petugas');
    }
}
