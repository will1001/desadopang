<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;	
use PhpOffice\PhpWord\PhpWord;
use App\data_penduduk;
use App\kode_area_dusun;
use App\kopsurat;
use Carbon;

class suratcontroller extends Controller
{


     public function formsurat($id)
    {
        if(Auth::user()->roles == "member"){
        $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
        $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
        return view("surat/".$id,['data_penduduks' => $data_penduduks,'kode_area_dusuns' => $kode_area_dusuns]);
        }else{
            
            return redirect('admin');
        }

    }


    public function surat_ket_domisili($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_domisili.docx');
          $hasil   = public_path('storage/surat/surat_ket_domisili_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_KK',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_domisili.docx');
          $hasil   = public_path('storage/surat/surat_ket_domisili_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_KK',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




    public function surat_ket_pindah_penduduk($NIK)
    {

        if(Auth::user()->roles == "member"){

        
          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();
  

          $mytime = Carbon\Carbon::now();

        
          $file   = public_path('storage/surat/surat_ket_pindah_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_ket_pindah_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);  
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

        
          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();
  

          $mytime = Carbon\Carbon::now();

        
          $file   = public_path('storage/surat/surat_ket_pindah_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_ket_pindah_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);  
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


     

    

    public function surat_izin_keramaian($NIK)
    {

        if(Auth::user()->roles == "member"){

          // Surat izin keramaian

        
          $file   = public_path('storage/surat/nikah/surat_izin_keramaian.docx');
          $hasil   = public_path('storage/surat/nikah/surat_izin_keramaian_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          // Surat izin keramaian

        
          $file   = public_path('storage/surat/nikah/surat_izin_keramaian.docx');
          $hasil   = public_path('storage/surat/nikah/surat_izin_keramaian_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_kehendak_nikah($NIK)
    {

        if(Auth::user()->roles == "member"){

        

          // surat kehendak nikah
          $file   = public_path('storage/surat/nikah/surat_kehendak_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_kehendak_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        



        }elseif(Auth::user()->roles == "kades"){

        

          // surat kehendak nikah
          $file   = public_path('storage/surat/nikah/surat_kehendak_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_kehendak_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_nikah($NIK)
    {

        if(Auth::user()->roles == "member"){

        

          // surat keterangan nikah

          $file   = public_path('storage/surat/nikah/surat_ket_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          
          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        


        }elseif(Auth::user()->roles == "kades"){

        

          // surat keterangan nikah

          $file   = public_path('storage/surat/nikah/surat_ket_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          
          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        


        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali($NIK)
    {

        if(Auth::user()->roles == "member"){

        
          // Surat keterangan Wali
          $file   = public_path('storage/surat/nikah/surat_ket_wali.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
        



        }elseif(Auth::user()->roles == "kades"){

        
          // Surat keterangan Wali
          $file   = public_path('storage/surat/nikah/surat_ket_wali.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali_hakim($NIK)
    {

        if(Auth::user()->roles == "member"){

         
          // Surat keterangan Wali hakim
           $file   = public_path('storage/surat/nikah/surat_ket_wali_hakim.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_hakim_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
          



        }elseif(Auth::user()->roles == "kades"){

         
          // Surat keterangan Wali hakim
           $file   = public_path('storage/surat/nikah/surat_ket_wali_hakim.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_hakim_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
          



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_persetujuan_mempelai($NIK)
    {

        if(Auth::user()->roles == "member"){

        
          // Surat Persetujuan mempelai
          $file   = public_path('storage/surat/nikah/surat_persetujuan_mempelai.docx');
          $hasil   = public_path('storage/surat/nikah/surat_persetujuan_mempelai_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

        
          // Surat Persetujuan mempelai
          $file   = public_path('storage/surat/nikah/surat_persetujuan_mempelai.docx');
          $hasil   = public_path('storage/surat/nikah/surat_persetujuan_mempelai_.docx');
          $phpWord = new PhpWord();

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




     public function surat_bio_penduduk($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_bio_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_bio_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('no_passpor',$data_penduduks[0]->No_Passpor);
          $doc -> setValue('tanggal_akhir_passpor',$data_penduduks[0]->Tanggal_akhir_Paspor);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('akta_lahir',$data_penduduks[0]->Akta_Lahir);
          $doc -> setValue('gol_darah',$data_penduduks[0]->Golongan_Darah);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('no_akta_perkawinan',$data_penduduks[0]->No_Akta_Perkawinan);
          $doc -> setValue('tanggal_perkawinan',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perkawinan)));
          $doc -> setValue('no_akta_perceraian',$data_penduduks[0]->No_Akta_Perceraian);
          $doc -> setValue('tanggal_perceraian',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perceraian)));
          $doc -> setValue('status_hubungan_dalam_keluarga',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga);
          $doc -> setValue('cacat',$data_penduduks[0]->Cacat);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('nama_ibu',$data_penduduks[0]->Nama_Ibu);
          $doc -> setValue('nik_ibu',$data_penduduks[0]->NIK_Ibu);
          $doc -> setValue('nama_ayah',$data_penduduks[0]->Nama_Ayah);
          $doc -> setValue('nik_ayah',$data_penduduks[0]->NIK_Ayah);


          
          
          
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_bio_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_bio_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('no_passpor',$data_penduduks[0]->No_Passpor);
          $doc -> setValue('tanggal_akhir_passpor',$data_penduduks[0]->Tanggal_akhir_Paspor);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('akta_lahir',$data_penduduks[0]->Akta_Lahir);
          $doc -> setValue('gol_darah',$data_penduduks[0]->Golongan_Darah);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('no_akta_perkawinan',$data_penduduks[0]->No_Akta_Perkawinan);
          $doc -> setValue('tanggal_perkawinan',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perkawinan)));
          $doc -> setValue('no_akta_perceraian',$data_penduduks[0]->No_Akta_Perceraian);
          $doc -> setValue('tanggal_perceraian',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perceraian)));
          $doc -> setValue('status_hubungan_dalam_keluarga',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga);
          $doc -> setValue('cacat',$data_penduduks[0]->Cacat);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('nama_ibu',$data_penduduks[0]->Nama_Ibu);
          $doc -> setValue('nik_ibu',$data_penduduks[0]->NIK_Ibu);
          $doc -> setValue('nama_ayah',$data_penduduks[0]->Nama_Ayah);
          $doc -> setValue('nik_ayah',$data_penduduks[0]->NIK_Ayah);


          
          
          
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




     public function surat_domisili_usaha_non_warga($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_domisili_usaha_non_warga.docx');
          $hasil   = public_path('storage/surat/surat_domisili_usaha_non_warga_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_domisili_usaha_non_warga.docx');
          $hasil   = public_path('storage/surat/surat_domisili_usaha_non_warga_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_izin_pengangkutan_kayu($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_izin_pengangkutan_kayu.docx');
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_kayu_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_izin_pengangkutan_kayu.docx');
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_kayu_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_izin_pengangkutan_tanah_urug($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug.docx');
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug.docx');
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_beda_identitas_kis($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_beda_identitas_kis.docx');
          $hasil   = public_path('storage/surat/surat_ket_beda_identitas_kis_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_beda_identitas_kis.docx');
          $hasil   = public_path('storage/surat/surat_ket_beda_identitas_kis_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


    public function surat_ket_beda_nama($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_beda_nama.docx');
          $hasil   = public_path('storage/surat/surat_ket_beda_nama_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_beda_nama.docx');
          $hasil   = public_path('storage/surat/surat_ket_beda_nama_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_catatan_kriminal($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_catatan_kriminal.docx');
          $hasil   = public_path('storage/surat/surat_ket_catatan_kriminal_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_catatan_kriminal.docx');
          $hasil   = public_path('storage/surat/surat_ket_catatan_kriminal_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


    public function surat_ket_cerai($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_cerai.docx');
          $hasil   = public_path('storage/surat/surat_ket_cerai_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_cerai.docx');
          $hasil   = public_path('storage/surat/surat_ket_cerai_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


     public function surat_ket_domisili_usaha($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_domisili_usaha.docx');
          $hasil   = public_path('storage/surat/surat_ket_domisili_usaha_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_domisili_usaha.docx');
          $hasil   = public_path('storage/surat/surat_ket_domisili_usaha_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }

    
    public function surat_ket_harga_tanah($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_harga_tanah.docx');
          $hasil   = public_path('storage/surat/surat_ket_harga_tanah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_harga_tanah.docx');
          $hasil   = public_path('storage/surat/surat_ket_harga_tanah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


    public function surat_ket_jamkesos($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_jamkesos.docx');
          $hasil   = public_path('storage/surat/surat_ket_jamkesos_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_jamkesos.docx');
          $hasil   = public_path('storage/surat/surat_ket_jamkesos_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_kehilangan($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kehilangan.docx');
          $hasil   = public_path('storage/surat/surat_ket_kehilangan_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kehilangan.docx');
          $hasil   = public_path('storage/surat/surat_ket_kehilangan_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


    public function surat_ket_jual_beli($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_jual_beli.docx');
          $hasil   = public_path('storage/surat/surat_ket_jual_beli_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_jual_beli.docx');
          $hasil   = public_path('storage/surat/surat_ket_jual_beli_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




    public function surat_ket_kelakuan_baik($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kelakuan_baik.docx');
          $hasil   = public_path('storage/surat/surat_ket_kelakuan_baik_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kelakuan_baik.docx');
          $hasil   = public_path('storage/surat/surat_ket_kelakuan_baik_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_kepemilikan_kendaraan($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan.docx');
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan.docx');
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_kepemilikan_tanah($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kepemilikan_tanah.docx');
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_tanah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kepemilikan_tanah.docx');
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_tanah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_kurang_mampu($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kurang_mampu.docx');
          $hasil   = public_path('storage/surat/surat_ket_kurang_mampu_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_kurang_mampu.docx');
          $hasil   = public_path('storage/surat/surat_ket_kurang_mampu_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




    public function surat_ket_luar_daerah($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_luar_daerah.docx');
          $hasil   = public_path('storage/surat/surat_ket_luar_daerah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_luar_daerah.docx');
          $hasil   = public_path('storage/surat/surat_ket_luar_daerah_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_luar_negeri($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_luar_negeri.docx');
          $hasil   = public_path('storage/surat/surat_ket_luar_negeri_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_luar_negeri.docx');
          $hasil   = public_path('storage/surat/surat_ket_luar_negeri_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_penduduk($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_ket_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_ket_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


    public function surat_ket_tidak_memiliki_jamkesos($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos.docx');
          $hasil   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos.docx');
          $hasil   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }



    public function surat_ket_usaha($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_usaha.docx');
          $hasil   = public_path('storage/surat/surat_ket_usaha_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_usaha.docx');
          $hasil   = public_path('storage/surat/surat_ket_usaha_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_yatim($NIK)
    {

        if(Auth::user()->roles == "member"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('Nomor_KK',Auth::user()->Nomor_KK)->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_yatim.docx');
          $hasil   = public_path('storage/surat/surat_ket_yatim_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          $data_penduduks = \DB::table('data_penduduks')
              ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
              ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
              ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
              ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
              ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
              ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
              ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
              ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
              ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga')
              ->where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
          $kopsurats=kopsurat::all();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_yatim.docx');
          $hasil   = public_path('storage/surat/surat_ket_yatim_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $doc -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $doc -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $doc -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->agama);
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $doc -> setValue('alamat',$data_penduduks[0]->Alamat);
          $doc -> setValue('rt',$data_penduduks[0]->RT);
          $doc -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $doc -> setValue('dusun',"-");

          }else{
            $doc -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




}
