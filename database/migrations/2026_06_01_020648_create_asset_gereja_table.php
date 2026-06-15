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
        Schema::create('asset_gereja', function (Blueprint $table) {
            $table->id('id_asset');
            $table->string('nama_aset');
            $table->integer('jumlah');
            $table->enum('kondisi', ['layak', 'kurang_layak', 'tidak_layak'])->default('layak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_gereja');
    }
};
