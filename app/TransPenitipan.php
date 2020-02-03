<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransPenitipan extends Model
{
    protected $table = 'detail_transaksi_penitipan';
    protected $fillable = [
    'no_penitipan',
    'nama_hewan',
    'jk_hewan',
    'ras_hewan',
    'no_kandang',
    'jenis_kandang',
    'id_penitipan',
    'id_jenis',
    'id_petugas',
    'status_pembayaran',
    ];

    public function transaksi_penitipan() {
        return $this->belongsTo(Penitipan::class, 'id_penitipan');
    }

    public function jenis() {
        return $this->hasOneThrough(Jenis::class, 'id_jenis');
    }

    public function petugas() {
        return $this->hasOneThrough(User::class, 'id_petugas');
    }
}
