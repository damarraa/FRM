<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus cache role dan permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar form yang ada di sistem
        $forms = [
            'kwh_meter',
            'mcb',
            'kotak_app',
            'cable_power',
            'konduktor',
            'trafo_distribusi',
            'lightning_arrester',
            'fuse_cut_out',
            'isolator',
            'cubicle',
            'phbtr',
            'ct',
            'pt',
            'lbs',
            'tiang_listrik',
            'pabrikan',
            'uid',
            'up3',
            'ulp',
            'laporan',
            'manajemen-user',
        ];

        // Permission tambahan
        $additionalPermissions = ['view_profile', 'update_profile', 'assign_role'];

        $permissions = [];

        // Buat daftar permission untuk setiap form
        foreach ($forms as $form) {
            $permissions = array_merge($permissions, [
                "index_{$form}",
                "store_{$form}",
                "show_{$form}",
                "update_{$form}",
                "export_pdf_{$form}",
                "approve_{$form}"
            ]);
        }

        // Tambahkan permission tambahan
        $permissions = array_merge($permissions, $additionalPermissions);

        // Buat permissions di database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat Role
        $petugas = Role::firstOrCreate(['name' => 'Petugas', 'desc' => 'PETUGAS']);
        $pic_gudang = Role::firstOrCreate(['name' => 'PIC_Gudang', 'desc' => 'PIC GUDANG']);
        $admin = Role::firstOrCreate(['name' => 'Admin', 'desc' => 'ADMIN']);

        // Assign permission ke masing-masing role
        foreach ($forms as $form) {
            // Petugas hanya bisa membuat dan melihat form
            $petugas->givePermissionTo(["index_{$form}", "store_{$form}", "show_{$form}", "update_{$form}"]);

            // PIC Gudang bisa melihat, mengedit, dan mencetak form
            $pic_gudang->givePermissionTo(["index_{$form}", "show_{$form}", "update_{$form}", "export_pdf_{$form}"]);

            // Admin bisa semua
            $admin->givePermissionTo([
                "index_{$form}",
                "store_{$form}",
                "show_{$form}",
                "update_{$form}",
                "export_pdf_{$form}"
            ]);
    }

        // Permissions untuk Profile Setting
        $petugas->givePermissionTo(["view_profile", "update_profile"]);
        $pic_gudang->givePermissionTo(["view_profile", "update_profile"]);
        $admin->givePermissionTo(Permission::all()); // Admin bisa semua, termasuk `assign_role`
    }
}
