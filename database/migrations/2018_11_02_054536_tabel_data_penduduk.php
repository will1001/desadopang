<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelDataPenduduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->string('Alamat')->nullable();
            $table->integer('Id_Dusun')->nullable();
            $table->integer('RW')->nullable();
            $table->integer('RT')->nullable();
            $table->string('Nama')->nullable();
            $table->string('Nomor_KK')->nullable();
            $table->string('NIK')->unique();;
            $table->string('Jenis_Kelamin')->nullable();
            $table->string('Tempat_Lahir')->nullable();
            $table->date('Tanggal_Lahir')->nullable();
            $table->string('Agama')->nullable();
            $table->string('Pendidikan')->nullable();
            $table->string('Jenis_Pekerjaan')->nullable();
            $table->string('Status_Perkawinan')->nullable();
            $table->string('Status_Hubungan_Dalam_Keluarga')->nullable();
            $table->string('Kewarganegaraan')->nullable();
            $table->string('Nama_Ayah')->nullable();
            $table->string('Nama_Ibu')->nullable();
            $table->string('Golongan_Darah')->nullable();
            $table->string('Akta_Lahir')->nullable();
            $table->string('No_Paspor')->nullable();
            $table->date('Tanggal_akhir_Paspor')->nullable();
            $table->string('No_KITAS')->nullable();
            $table->string('NIK_Ayah')->nullable();
            $table->string('NIK_Ibu')->nullable();
            $table->string('No_Akta_Perkawinan')->nullable();
            $table->date('Tanggal_Perkawinan')->nullable();
            $table->string('No_Akta_Perceraian')->nullable();
            $table->date('Tanggal_Perceraian')->nullable();
            $table->string('Cacat')->nullable();
            $table->string('Cara_KB')->nullable();
            $table->string('Hamil')->nullable();
            $table->string('Status_kependudukan')->nullable();
            $table->text('Keterangan')->nullable();
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
        Schema::dropIfExists('data_penduduks')->nullable();
    }
}
