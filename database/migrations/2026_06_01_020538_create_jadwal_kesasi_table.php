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
        Schema::create('jadwal_kesasi', function (Blueprint $table) {
           $table->id('id_kesasi');
             $table->foreignId('id_pengajar')->constrained('pelayan', 'id_pelayan');
            $table->datetime('waktu');
            $table->string('materi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kesasi');
    }
};
