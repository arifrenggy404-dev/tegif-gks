<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table      = 'keuangan';
    protected $primaryKey = 'id_keuangan';

    protected $fillable = [
        'id_user',
        'jenis_transaksi',
        'tanggal_transaksi',
        'total',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'total'             => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Scope pemasukan
    public function scopePemasukan($query)
    {
        return $query->where('jenis_transaksi', 'pemasukan');
    }

    // Scope pengeluaran
    public function scopePengeluaran($query)
    {
        return $query->where('jenis_transaksi', 'pengeluaran');
    }
}