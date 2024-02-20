<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataDummy = [
            [
                'nip' => 'A1818',
                'nama' => 'admin',
                'password' => Hash::make('Password1'),
                'role' => 'Admin'
            ],
            [
                'nip' => 'A1717',
                'nama' => 'sales',
                'password' => Hash::make('Password1'),
                'role' => 'Sales'
            ],
        ];
        DB::table('users')->insert($dataDummy);
    }
}
