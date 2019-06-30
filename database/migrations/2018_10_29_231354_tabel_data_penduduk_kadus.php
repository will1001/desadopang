<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelDataPendudukKadus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('data_penduduk_kaduss', function (Blueprint $table) {
            $table->increments('id')->unique();;
            $table->string('Nama');
            $table->string('NIK');
            $table->string('Kelahiran');
            $table->string('Kematian');
            $table->string('Penduduk_Masuk');
            $table->string('Penduduk_Keluar');
            $table->string('Keterangan');
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
        //
        Schema::dropIfExists('data_penduduk_kaduss');
    }
}
