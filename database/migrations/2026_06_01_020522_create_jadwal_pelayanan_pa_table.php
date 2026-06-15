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
        Schema::create('jadwal_pelayanan_pa', function (Blueprint $table) {
            $table->id('id_pelayanan_pa');
            $table->foreignId('id_wilayah')->constrained('wilayah', 'id_wilayah');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nama_penerima_pa');
            $table->foreignId('id_pelayan')->constrained('pelayan', 'id_pelayan');
            $table->foreignId('id_pendamping')->constrained('pelayan', 'id_pelayan');
            $table->string('ayat');
            $table->datetime('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelayanan_pa');
    }
};
