<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'jemaat';        // ✅ samakan dengan nama tabel di migration
    protected $primaryKey = 'id_jemaat'; // pastikan ini juga ada, karena PK bukan 'id'

    protected $fillable = [
        'nama_jemaat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'tempat_baptis',
        'tanggal_baptis',
        'tempat_sidi',
        'tanggal_sidi',
        'tempat_nikah',
        'tanggal_nikah',
        'pekerjaan',
        'status_dalam_jemaat',
        'hubungan_keluarga',
        'pendidikan_terakhir',
        'id_wilayah',
        'alamat',
        'no_hp',
        'status_jemaat',
        'status_pernikahan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_lahir'  => 'date',
        'tanggal_baptis' => 'date',
        'tanggal_sidi'   => 'date',
        'tanggal_nikah'  => 'date',
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah');
    }
}
