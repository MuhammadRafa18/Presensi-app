<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;



class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create',
            'edit',
            'update',
            'delete',
            'presensi',
            'laporan'
         ];

         foreach ($permissions as $permission) {
            Permission::updateOrcreate(['name' => $permission]);
          }
    }
}
