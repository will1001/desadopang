<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profildesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profildesas', function (Blueprint $table) {
            $table->increments('id')->unique();;
            $table->string('desripsiprofildesa');
            $table->string('fotokades');
            $table->string('fotoketbpd');
            $table->string('fotosekdes');
            $table->string('fotokaurpemerintahan');
            $table->string('fotokaurpembangunan');
            $table->string('fotokaurkeuangan');
            $table->string('fotokaurumum');
            $table->string('fotokaurkesra');
            $table->string('fotokaurtrantib');
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
        Schema::dropIfExists('profildesas');
    }
}
