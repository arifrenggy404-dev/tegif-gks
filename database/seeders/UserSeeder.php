<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'username' => 'admin',
                'nama' => 'Administrator',
                'email' => 'admin@tegif-gks.id',
                'password' => '$2y$12$mZEw7dkIOQUyMZYPt96Mp.rOB.jwXHQ9UXijoUArbmUkCEiFbKXEe',
                'role' => 'admin',
                'created_at' => '2026-06-12 04:55:32',
                'updated_at' => '2026-06-12 04:55:32',
            ],
            [
                'id_user' => 2,
                'username' => 'Mario',
                'nama' => 'Mario',
                'email' => 'alvinomario28@gmail.com',
                'password' => '$2y$12$Xi0MzR/r2NcueJ7vPiTv7OrUzVARA5n3FQ9IkXqzEZNRCaK/b5lwW',
                'role' => 'admin',
                'created_at' => '2026-06-12 04:56:08',
                'updated_at' => '2026-06-12 04:56:08',
            ],
            [
                'id_user' => 3,
                'username' => 'Alvin',
                'nama' => 'Alvin',
                'email' => 'Alvin@gmail.com',
                'password' => '$2y$12$s16xPl24PvQvAxcJBt.BueNqoHwyq.eGK.H.CK.YMJXwGenv1fhBS',
                'role' => 'bendahara',
                'created_at' => '2026-06-12 15:23:11',
                'updated_at' => '2026-06-12 15:23:11',
            ],
            [
                'id_user' => 4,
                'username' => 'Mar',
                'nama' => 'Mar',
                'email' => 'mar@gmail.com',
                'password' => '$2y$12$ifN72/CUxQTAIO9lhgKhBONoCdWOZiOZcYkBQqeMq/oQt70Dzbb7u',
                'role' => 'pengurus',
                'created_at' => '2026-06-12 15:24:26',
                'updated_at' => '2026-06-12 15:24:26',
            ],
        ]);
    }
}
