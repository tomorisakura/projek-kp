<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penitipan extends Model
{
    protected $table = "transaksi_penitipan";
    protected $fillable = [
    'id',
    'tgl_masuk',
    'tgl_keluar',
    'total_biaya',
    'id_pemilik',
  ];

    public function detail_transaksi_penitipan() {
      return $this->hasOneThrough(TransPenitipan::class , 'no_penitipan');
    }

    public function pelanggan() {
      return $this->belongsTo(Pelanggan::class, 'id_pemilik'); 
    }
}
