<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JemaatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jemaat')->insert([
            [
                'id_jemaat' => 1,
                'nama_jemaat' => 'Mario chalvino',
                'tempat_lahir' => 'Palakalumbang',
                'tanggal_lahir' => '2026-06-13',
                'tempat_baptis' => 'Kanatang',
                'tanggal_baptis' => '2026-06-13',
                'tempat_sidi' => 'Kanatang',
                'tanggal_sidi' => '2026-06-13',
                'tempat_nikah' => null,
                'tanggal_nikah' => null,
                'pekerjaan' => 'lainnya',
                'jenis_kelamin' => 'L',
                'status_dalam_jemaat' => 'sidi',
                'hubungan_keluarga' => 'Anak',
                'pendidikan_terakhir' => 'S1',
                'id_wilayah' => 1,
                'alamat' => "Parunu, RT.006, RW.003 Temu, Kanatang, 87153\r\nwaingapu",
                'no_hp' => '085138928216',
                'status_jemaat' => 'aktif',
                'status_pernikahan' => 'belum_menikah',
                'keterangan' => null,
                'created_at' => '2026-06-12 18:49:22',
                'updated_at' => '2026-06-12 18:49:22',
            ],
            [
                'id_jemaat' => 2,
                'nama_jemaat' => 'Yance',
                'tempat_lahir' => 'Wgp',
                'tanggal_lahir' => '2026-06-13',
                'tempat_baptis' => 'Kanatang',
                'tanggal_baptis' => '2026-06-13',
                'tempat_sidi' => 'Kanatang',
                'tanggal_sidi' => '2026-06-13',
                'tempat_nikah' => 'Kanatang',
                'tanggal_nikah' => '2026-06-13',
                'pekerjaan' => 'pns',
                'jenis_kelamin' => 'L',
                'status_dalam_jemaat' => 'sidi',
                'hubungan_keluarga' => 'Ayah',
                'pendidikan_terakhir' => 'S1',
                'id_wilayah' => 2,
                'alamat' => 'Kanatang',
                'no_hp' => '1234456768',
                'status_jemaat' => 'aktif',
                'status_pernikahan' => 'menikah',
                'keterangan' => null,
                'created_at' => '2026-06-12 19:17:34',
                'updated_at' => '2026-06-12 19:17:34',
            ],
        ]);
    }
}
