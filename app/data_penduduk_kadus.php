<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_penduduk_kadus extends Model
{
    //
    protected $fillable = ['Nama', 'NIK', 'Kelahiran', 'Kematian', 'Penduduk_Masuk', 'Penduduk_Keluar', 'Keterangan', 'id_kadus' ,'created_at', 'updated_at'];
}
