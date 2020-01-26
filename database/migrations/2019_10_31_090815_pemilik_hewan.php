<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PemilikHewan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pelanggan', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('nama_pemilik');
          $table->string('alamat');
          $table->bigInteger('no_hp');
          $table->string('email');
          $table->timestamps();
      });

      Schema::create('jenis_hewan', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('nama');
        $table->bigInteger('harga');
        $table->timestamps();
      });

      Schema::create('penyakit', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('nama_penyakit');
        $table->bigInteger('harga');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('jenis_hewan');
        Schema::dropIfExists('penyakit');
    }
}
