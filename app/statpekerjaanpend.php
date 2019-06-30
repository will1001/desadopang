<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statpekerjaanpend extends Model
{
    //
    protected $fillable = ['pekerjaan', 'pria', 'wanita', 'jumlah' ,'created_at', 'updated_at'];
}
