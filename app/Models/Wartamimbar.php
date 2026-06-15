<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Wartamimbar extends Model
{
    protected $table = 'wartamimbar';
    protected $primaryKey = 'id_wartamimbar';
    protected $fillable = ['id_user','id_ibadah','id_pelayanan_pa','informasi','tanggal'];
    protected $casts = ['tanggal' => 'date'];

    public function user()        { return $this->belongsTo(User::class, 'id_user', 'id_user'); }
    public function ibadah()      { return $this->belongsTo(JadwalIbadahMinggu::class, 'id_ibadah', 'id_ibadah'); }
    public function pelayananPa() { return $this->belongsTo(JadwalPelayananPa::class, 'id_pelayanan_pa', 'id_pelayanan_pa'); }
}