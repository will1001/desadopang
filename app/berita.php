<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    //
    protected $fillable = ['judulberita', 'deskripsi', 'urlgambar' ,'created_at', 'updated_at'];
}
