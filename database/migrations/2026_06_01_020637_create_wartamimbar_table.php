<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wartamimbar', function (Blueprint $table) {
            $table->id('id_wartamimbar');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->foreignId('id_ibadah')->constrained('jadwal_ibadah_minggu', 'id_ibadah');
            $table->foreignId('id_pelayanan_pa')->constrained('jadwal_pelayanan_pa', 'id_pelayanan_pa');
            $table->text('informasi');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wartamimbar');
    }
};
