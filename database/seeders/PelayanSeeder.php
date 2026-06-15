<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelayanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelayan')->insert([
            [
                'id_pelayan' => 1,
                'nama_pelayan' => 'Pdt.Mario Chalvino',
                'jenis' => 'pendeta',
                'aktif' => 1,
                'created_at' => '2026-06-12 18:49:34',
                'updated_at' => '2026-06-12 18:49:34',
            ],
            [
                'id_pelayan' => 2,
                'nama_pelayan' => 'vic.try',
                'jenis' => 'vikaris',
                'aktif' => 1,
                'created_at' => '2026-06-12 18:49:43',
                'updated_at' => '2026-06-12 18:49:43',
            ],
        ]);
    }
}
