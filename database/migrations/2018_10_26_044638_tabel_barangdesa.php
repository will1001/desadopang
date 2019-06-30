<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelBarangdesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('barangdesas', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nama');
            $table->string('harga');
            $table->string('jumlah');
            $table->string('urlgambar');
            $table->string('id_pemilik');
            $table->string('deskripsi');
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
        Schema::dropIfExists('barangdesas');
    }
}
