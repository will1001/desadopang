<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKodeAreaKadus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('kode_area_dusuns', function (Blueprint $table) {
            $table->increments('id_dusun')->unique();;
            $table->string('Nama_Dusun');
            $table->string('id_kadus');
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
        Schema::dropIfExists('kode_area_dusuns');
    }
}
