<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('keuangan')->insert([
            [
                'id_keuangan' => 1,
                'id_user' => 3,
                'jenis_transaksi' => 'pemasukan',
                'tanggal_transaksi' => '2026-06-15',
                'total' => 100000.00,
                'keterangan' => 'Persembahan',
                'created_at' => '2026-06-15 02:14:25',
                'updated_at' => '2026-06-15 02:14:25',
            ],
        ]);
    }
}
