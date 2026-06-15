<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelayananPaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_pelayanan_pa')->insert([
            [
                'id_pelayanan_pa' => 1,
                'id_wilayah' => 1,
                'id_user' => 1,
                'nama_penerima_pa' => 'Mario chalvino',
                'id_pelayan' => 1,
                'id_pendamping' => 2,
                'ayat' => 'Matius 18:1-12',
                'waktu' => '2026-06-13 10:49:00',
                'created_at' => '2026-06-12 18:50:03',
                'updated_at' => '2026-06-12 18:50:03',
            ],
        ]);
    }
}
