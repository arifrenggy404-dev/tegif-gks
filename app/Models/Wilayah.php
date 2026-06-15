<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'wilayah';

    // Menentukan primary key custom karena tidak menggunakan 'id' standar
    protected $primaryKey = 'id_wilayah';

    // Kolom yang diizinkan untuk pengisian massal
    protected $fillable = ['nama_wilayah'];

    /**
     * Relasi ke model Jemaat (Satu wilayah memiliki banyak jemaat)
     */
    public function jemaat(): HasMany
    {
        return $this->hasMany(Jemaat::class, 'id_wilayah', 'id_wilayah');
    }

    /**
     * Relasi ke model JadwalPelayananPa (Satu wilayah memiliki banyak jadwal PA)
     * Ditulis lengkap agar sinkron saat dipanggil untuk proses hapus berantai di Controller
     */
    public function jadwalPelayananPa(): HasMany
    {
        return $this->hasMany(JadwalPelayananPa::class, 'id_wilayah', 'id_wilayah');
    }
}