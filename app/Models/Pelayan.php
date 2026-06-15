<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pelayan extends Model
{
    protected $table = 'pelayan';
    protected $primaryKey = 'id_pelayan';
    protected $fillable = ['nama_pelayan', 'jenis', 'aktif'];

    public function scopeAktif($query) {
        return $query->where('aktif', true);
    }
}