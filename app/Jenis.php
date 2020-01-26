<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis_hewan';
    protected $fillable = [
    'nama',
    'harga',
    ];

    public function detail_transaksi_penitipan() {
        return $this->belongsTo(TransPenitipan::class, 'id_penitipan');
    }

    public function detail_transaksi_medis() {
        return $this->belongsTo(TransMedis::class, 'id_medis');
    }
}
