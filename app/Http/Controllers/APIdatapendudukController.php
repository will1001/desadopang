<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIdatapendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_penduduks=\DB::table('data_penduduks')
                ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
                ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
                ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
                ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
                ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
                ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
                ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
                ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
                ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')->get();


                $data_penduduks_excel=\DB::table('data_penduduks')
                ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
                ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
                ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
                ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
                ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
                ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
                ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
                ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
                ->select('data_penduduks.Alamat','data_penduduks.RW','data_penduduks.RT','data_penduduks.Nama','data_penduduks.Nomor_KK','data_penduduks.NIK','tabel_jenis_kelamins.jenis_kelamin','data_penduduks.Tempat_Lahir','data_penduduks.Tanggal_Lahir','data_penduduks.Usia','tabel_agamas.agama','tabel_pendidikans.pendidikan','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_status_perkawinans.status_perkawinan','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','tabel_kewarganegaraans.kewarganegaraan','data_penduduks.Nama_Ayah','data_penduduks.Nama_Ibu','tabel_golongan_darahs.golongan_darah','data_penduduks.Akta_Lahir','data_penduduks.No_Paspor','data_penduduks.Tanggal_akhir_Paspor','data_penduduks.No_KITAS','data_penduduks.NIK_Ayah','data_penduduks.NIK_Ibu','data_penduduks.No_Akta_Perkawinan','data_penduduks.Tanggal_Perkawinan','data_penduduks.No_Akta_Perceraian','data_penduduks.Tanggal_Perceraian','data_penduduks.Cacat','data_penduduks.Cara_KB','data_penduduks.Hamil','data_penduduks.Status_kependudukan','data_penduduks.Keterangan','data_penduduks.tempat_mendapatkan_air_bersih','data_penduduks.status_gizi_balita','data_penduduks.kebiasaan_berobat_bila_sakit')->get();

        return response()->json(['data_penduduks' => $data_penduduks,'data_penduduks_excel' => $data_penduduks_excel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data_pendudukdusuns=\DB::table('data_penduduks')
                ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
                ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
                ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
                ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
                ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
                ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
                ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
                ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
                ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')->take(10)->skip($id)->get();

        return response()->json(['data_pendudukdusuns' => $data_pendudukdusuns]);
    }


    public function searchdata($kategori,$id)
    {
        //
        $data_penduduksearchs=\DB::table('data_penduduks')
                ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
                ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
                ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
                ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
                ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
                ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
                ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
                ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
                ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')->where($kategori,'LIKE','%'.$id.'%')->get();

        return response()->json(['data_penduduksearchs' => $data_penduduksearchs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
