<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin1',
            'password' => 'admin1234',
        ]);

        $admin->assignRole('Admin');

        $guru = User::create([
            'name' => 'Guru',
            'username' => 'guru1',
            'password' => 'guru1234',
        ]);

        $guru->assignRole('Guru');

        $bk = User::create([
            'name' => 'BK',
            'username' => 'bk1',
            'password' => 'bk1234',
        ]);
        $bk->assignRole('Bk');

        $adminGuru = User::create([
            'name' => 'Admin-Guru',
            'username' => 'admin-guru12',
            'password' => 'admin-guru1234',
        ]);
        $adminGuru->assignRole(['Admin', 'Guru']);


    }
}
