<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransMedis extends Model
{
    protected $table = "detail_transaksi_medis";
    protected $fillable = [
    'no_medis',
    'nama_hewan',
    'jk_hewan',
    'ras_hewan',
    'gejala',
    'id_medis',
    'id_jenis',
    'id_penyakit',
    'id_petugas',
  ];

    public function transaksi_medis() {
      return $this->belongsTo(Medis::class, 'id_medis');
    }

    public function jenis() {
      return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function penyakit() {
      return $this->belongsTo(Penyakit::class, 'id_penyakit');
    }

    public function petugas() {
      return $this->hasOneThrough(User::class, 'id_petugas');
    }
}
