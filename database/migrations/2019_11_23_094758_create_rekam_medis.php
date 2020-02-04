<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekamMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaksi_medis', function(Blueprint $table){
        $table->string('id')->primary();
        $table->string('tgl_periksa');
        $table->integer('total_biaya');
        $table->unsignedBigInteger('id_pemilik')->unsigned();
        $table->string('status_pembayaran');
        $table->timestamps();
      });
      
      Schema::create('detail_transaksi_medis', function(Blueprint $table){
        $table->bigIncrements('id');
        $table->string('nama_hewan');
        $table->enum('jk_hewan', ['Jantan','Betina']);
        $table->string('ras_hewan');
        $table->string('gejala');
        $table->integer('harga_detail');
        $table->string('id_medis')->index();
        $table->unsignedBigInteger('id_jenis');
        $table->unsignedBigInteger('id_penyakit');
        $table->unsignedBigInteger('id_petugas');
        $table->timestamps();
      });

      Schema::table('transaksi_medis', function(Blueprint $column){
        $column->foreign('id_pemilik')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
      });
      
      Schema::table('detail_transaksi_medis', function(Blueprint $column) {
        $column->foreign('id_medis')->references('id')->on('transaksi_medis')->onDelete('cascade')->onUpdate('cascade');
        $column->foreign('id_petugas')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $column->foreign('id_jenis')->references('id')->on('jenis_hewan')->onDelete('cascade')->onUpdate('cascade');        
        $column->foreign('id_penyakit')->references('id')->on('penyakit')->onDelete('cascade')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('transaksi_medis');
      Schema::dropIfExists('detail_transaksi_medis');
    }
}
