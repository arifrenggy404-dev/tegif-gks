<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'id_kunjungan';
    protected $fillable = ['tujuan','waktu_kunjungan','id_wilayah'];
    protected $casts = ['waktu_kunjungan' => 'datetime'];

    public function wilayah() { return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah'); }
}