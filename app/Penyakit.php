<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';
    protected $fillable = [
    'nama_penyakit',
    'harga',
    ];

    public function detail_transaksi_medis() {
        return $this->belongsTo(TransMedis::class, 'id_penyakit');
    }
}
