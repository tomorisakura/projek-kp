<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenitipan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penitipan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('tgl_masuk');
            $table->string('tgl_keluar');
            $table->integer('total_biaya');
            $table->unsignedBigInteger('id_pemilik');
            $table->string('status_pembayaran');
            $table->unsignedBigInteger('id_petugas');
            $table->timestamps();
        });
        
        Schema::create('detail_transaksi_penitipan', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_hewan');
            $table->enum('jk_hewan', ['Jantan','Betina']);
            $table->string('ras_hewan');
            $table->integer('no_kandang');
            $table->string('jenis_kandang');
            $table->integer('harga_detail');
            $table->string("id_penitipan")->index();
            $table->unsignedBigInteger('id_jenis');
            $table->timestamps();
        });

        Schema::table('transaksi_penitipan', function(Blueprint $column) {
            $column->foreign('id_pemilik')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $column->foreign('id_petugas')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('detail_transaksi_penitipan', function(Blueprint $column) {
            $column->foreign('id_penitipan')->references('id')->on('transaksi_penitipan')->onDelete('cascade')->onUpdate('cascade');
            $column->foreign('id_jenis')->references('id')->on('jenis_hewan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_penitipan');
        Schema::dropIfExists('detail_transaksi_penitipan');
    }
}
