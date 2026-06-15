<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadahMinggu extends Model
{
    protected $table = 'jadwal_ibadah_minggu';
    protected $primaryKey = 'id_ibadah';

    protected $fillable = [
        'id_user',
        'id_pelayan',
        'id_pendamping',
        'tema',
        'ayat_bacaan',
        'nats_pembimbing',
        'ayat_firman',
        'berita_anugerah',
        'petunjuk_hidup_baru',
        'waktu',
        'lokasi',
    ];

    protected $casts = ['waktu' => 'datetime'];

    public function user()      { return $this->belongsTo(User::class, 'id_user', 'id_user'); }
    public function pelayan()   { return $this->belongsTo(Pelayan::class, 'id_pelayan', 'id_pelayan'); }
    public function pendamping(){ return $this->belongsTo(Pelayan::class, 'id_pendamping', 'id_pelayan'); }
}
