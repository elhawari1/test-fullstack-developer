<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataDummy = [
            [
                'nama' => 'Home 1',
                'harga' => '100000'
            ],
            [
                'nama' => 'Home 2',
                'harga' => '150000'
            ],
            [
                'nama' => 'Home 3',
                'harga' => '200000'
            ],
        ];
        DB::table('tbl_paket')->insert($dataDummy);
    }
}
