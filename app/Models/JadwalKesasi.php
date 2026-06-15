<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalKesasi extends Model
{
    protected $table = 'jadwal_kesasi';
    protected $primaryKey = 'id_kesasi';
    protected $fillable = ['id_pengajar','waktu','materi'];
    protected $casts = ['waktu' => 'datetime'];

    public function pengajar()
    {
        return $this->belongsTo(Pelayan::class, 'id_pengajar', 'id_pelayan');
    }
}