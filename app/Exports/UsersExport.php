<?php

namespace App\Exports;

use App\data_penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return \DB::table('data_penduduks')
	            ->join('kode_area_dusuns', 'data_penduduks.Id_Dusun', '=', 'kode_area_dusuns.id_dusun')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->select('data_penduduks.Alamat','data_penduduks.Nama','data_penduduks.Nomor_KK','data_penduduks.NIK','data_penduduks.Tempat_Lahir','data_penduduks.Tanggal_Lahir','kode_area_dusuns.Nama_Dusun', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
	            ->get();
    }
}
