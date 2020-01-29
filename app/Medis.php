<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medis extends Model
{
    protected $table = "transaksi_medis";
    protected $fillable = [
    'id',
    'tgl_periksa',
    'total_biaya',
    'id_pemilik',
    'status_pembayaran'
  ];

    public function detail_transaksi_medis() {
      return $this->hasMany(TransMedis::class, 'id_medis');
    }

    public function pelanggan() {
      return $this->hasMany(Pelanggan::class, 'id_pemilik');
    }
}
