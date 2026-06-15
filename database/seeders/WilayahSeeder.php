<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wilayah')->insert([
            [
                'id_wilayah' => 1,
                'nama_wilayah' => 'Taimanu',
                'created_at' => '2026-06-12 18:48:24',
                'updated_at' => '2026-06-12 18:48:24',
            ],
            [
                'id_wilayah' => 2,
                'nama_wilayah' => 'Temu A 1',
                'created_at' => '2026-06-12 18:48:39',
                'updated_at' => '2026-06-12 18:48:39',
            ],
        ]);
    }
}
