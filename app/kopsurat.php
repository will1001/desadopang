<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kopsurat extends Model
{
    //
    protected $fillable = ['Nama_Kabupaten','Nama_Kecamatan','Nama_Desa', 'Alamat_Desa'];
    public $timestamps = false;
}
