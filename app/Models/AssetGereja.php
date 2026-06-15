<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssetGereja extends Model
{
    protected $table = 'asset_gereja';
    protected $primaryKey = 'id_asset';
    protected $fillable = ['nama_aset','jumlah','kondisi'];
}