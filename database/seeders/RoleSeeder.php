<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $guru = Role::create(['name' => 'Guru']);
        $bk= Role::create(['name' => 'Bk']);

        $admin->givePermissionTo([
           'create',
           'edit',
           'update',
           'delete',
           'presensi',
           'laporan'
        ]);

        $guru->givePermissionTo([
            'presensi',
            'laporan'

        ]);
        $bk->givePermissionTo([
            'presensi'

        ]);
    }
}
