<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id('id_jemaat');

            // Nama
            $table->string('nama_jemaat');

            // Tempat & Tgl. Lahir
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Tempat/Tgl. Baptis, Sidi, dan Nikah
            $table->string('tempat_baptis')->nullable();
            $table->date('tanggal_baptis')->nullable();
            $table->string('tempat_sidi')->nullable();
            $table->date('tanggal_sidi')->nullable();
            $table->string('tempat_nikah')->nullable();
            $table->date('tanggal_nikah')->nullable();

            // Pekerjaan (Petani, Nelayan, Tukang, Buruh, PNS, PT, Swasta, TNI/POLRI, Pensiun)
            $table->enum('pekerjaan', [
                'petani',
                'nelayan',
                'tukang',
                'buruh',
                'pns',
                'pt',
                'swasta',
                'tni_polri',
                'pensiun',
                'lainnya'
            ])->nullable();

            // Jenis Kelamin (untuk kolom L/P pada Status Dalam Jemaat & Pendidikan)
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Status Dalam Jemaat (Sidi, Baptis, Belum Baptis, Simpatisan)
            $table->enum('status_dalam_jemaat', ['sidi', 'baptis', 'belum_baptis', 'simpatisan'])
                ->default('belum_baptis');

            // Hub. Kel (hubungan dalam keluarga, misal: Kepala Keluarga, Istri, Anak)
            $table->string('hubungan_keluarga')->nullable();

            // Pendidikan Terakhir (SD, SMP, SMA, AMD/D3, S1/S2)
            $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2'])->nullable();

            // Relasi Wilayah
            $table->foreignId('id_wilayah')->constrained('wilayah', 'id_wilayah')->onDelete('cascade');

            // Data tambahan
            $table->text('alamat')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->enum('status_jemaat', ['aktif', 'tidak_aktif', 'pindah', 'meninggal'])->default('aktif');
            $table->enum('status_pernikahan', ['belum_menikah', 'menikah', 'duda', 'janda'])->default('belum_menikah');

            // Keterangan
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jemaat');
    }
};
