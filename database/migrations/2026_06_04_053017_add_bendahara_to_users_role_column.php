<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL: ubah enum dengan menambah 'bendahara'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','pengurus','bendahara') NOT NULL DEFAULT 'pengurus'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','pengurus') NOT NULL DEFAULT 'pengurus'");
    }
};