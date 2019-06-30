<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_penduduk extends Model
{
    //
    protected $fillable = ['Nama_Lengkap', 'NIK', 'Jenis_Kelamin', 'Tempat_Lahir', 'Tanggal_Lahir', 'Agama', 'Pendidikan', 'Jenis_Pekerjaan', 'Status_Perkawinan', 'Status_Hubungan_Dalam_Keluarga', 'Kewarganegaraan', 'No_Paspor', 'No_KITAP', 'Ayah', 'Ibu','id_dusun', 'Status_kependudukan', 'Keterangan','created_at', 'updated_at'];
}
