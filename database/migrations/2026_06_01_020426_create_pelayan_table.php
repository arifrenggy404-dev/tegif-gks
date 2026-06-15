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
        Schema::create('pelayan', function (Blueprint $table) {
             $table->id('id_pelayan');
             $table->string('nama_pelayan');
             $table->enum('jenis', ['pendeta', 'mejelis', 'vikaris'])->default('pendeta');
             $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayan');
    }
};
