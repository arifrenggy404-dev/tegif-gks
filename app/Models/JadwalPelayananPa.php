<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalPelayananPa extends Model
{
    protected $table = 'jadwal_pelayanan_pa';
    protected $primaryKey = 'id_pelayanan_pa';
    protected $fillable = ['id_wilayah','id_user','nama_penerima_pa','id_pelayan','id_pendamping','ayat','waktu'];
    protected $casts = ['waktu' => 'datetime'];

    public function wilayah()   { return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah'); }
    public function user()      { return $this->belongsTo(User::class, 'id_user', 'id_user'); }
    public function pelayan()   { return $this->belongsTo(Pelayan::class, 'id_pelayan', 'id_pelayan'); }
    public function pendamping(){ return $this->belongsTo(Pelayan::class, 'id_pendamping', 'id_pelayan'); }
}