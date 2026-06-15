<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ibadah_minggu', function (Blueprint $table) {
            $table->id('id_ibadah');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->foreignId('id_pelayan')->constrained('pelayan', 'id_pelayan');
            $table->foreignId('id_pendamping')->constrained('pelayan', 'id_pelayan');

            // Tema & Bacaan
            $table->string('tema')->nullable();
            $table->string('ayat_bacaan');
            $table->string('nats_pembimbing')->nullable();
            $table->string('ayat_firman')->nullable();

            // Unsur Liturgi
            $table->text('berita_anugerah')->nullable();
            $table->text('petunjuk_hidup_baru')->nullable();

            $table->datetime('waktu');
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadah_minggu');
    }
};
