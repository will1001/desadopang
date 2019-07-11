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
          $hasil   = public_path('storage/surat/surat_ket_domisili_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_KK',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_domisili_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_KK',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_pindah_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);  
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_pindah_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);  
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('kewarganegaraan',$data_penduduks[0]->kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }


     

    

    public function surat_izin_keramaian($NIK)
    {

        if(Auth::user()->roles == "member"){

          // Surat izin keramaian

        
          $file   = public_path('storage\surat\Nikah\surat_izin_keramaian.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_izin_keramaian_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

          // Surat izin keramaian

        
          $file   = public_path('storage\surat\Nikah\surat_izin_keramaian.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_izin_keramaian_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_kehendak_nikah($NIK)
    {

        if(Auth::user()->roles == "member"){

        

          // surat kehendak nikah
          $file   = public_path('storage\surat\Nikah\surat_kehendak_nikah.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_kehendak_nikah_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        



        }elseif(Auth::user()->roles == "kades"){

        

          // surat kehendak nikah
          $file   = public_path('storage\surat\Nikah\surat_kehendak_nikah.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_kehendak_nikah_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_nikah($NIK)
    {

        if(Auth::user()->roles == "member"){

        

          // surat keterangan nikah

          $file   = public_path('storage\surat\Nikah\surat_ket_nikah.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_nikah_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          
          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        


        }elseif(Auth::user()->roles == "kades"){

        

          // surat keterangan nikah

          $file   = public_path('storage\surat\Nikah\surat_ket_nikah.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_nikah_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          
          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        


        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali($NIK)
    {

        if(Auth::user()->roles == "member"){

        
          // Surat keterangan Wali
          $file   = public_path('storage\surat\Nikah\surat_ket_wali.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_wali_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
        



        }elseif(Auth::user()->roles == "kades"){

        
          // Surat keterangan Wali
          $file   = public_path('storage\surat\Nikah\surat_ket_wali.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_wali_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali_hakim($NIK)
    {

        if(Auth::user()->roles == "member"){

         
          // Surat keterangan Wali hakim
           $file   = public_path('storage\surat\Nikah\surat_ket_wali_hakim.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_wali_hakim_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
          



        }elseif(Auth::user()->roles == "kades"){

         
          // Surat keterangan Wali hakim
           $file   = public_path('storage\surat\Nikah\surat_ket_wali_hakim.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_ket_wali_hakim_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
          



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_persetujuan_mempelai($NIK)
    {

        if(Auth::user()->roles == "member"){

        
          // Surat Persetujuan mempelai
          $file   = public_path('storage\surat\Nikah\surat_persetujuan_mempelai.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_persetujuan_mempelai_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }elseif(Auth::user()->roles == "kades"){

        
          // Surat Persetujuan mempelai
          $file   = public_path('storage\surat\Nikah\surat_persetujuan_mempelai.docx');
          $hasil   = public_path('storage\surat\Nikah\surat_persetujuan_mempelai_.doc');
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

          $docx   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_bio_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('no_passpor',$data_penduduks[0]->No_Passpor);
          $docx -> setValue('tanggal_akhir_passpor',$data_penduduks[0]->Tanggal_akhir_Paspor);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('akta_lahir',$data_penduduks[0]->Akta_Lahir);
          $docx -> setValue('gol_darah',$data_penduduks[0]->Golongan_Darah);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('no_akta_perkawinan',$data_penduduks[0]->No_Akta_Perkawinan);
          $docx -> setValue('tanggal_perkawinan',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perkawinan)));
          $docx -> setValue('no_akta_perceraian',$data_penduduks[0]->No_Akta_Perceraian);
          $docx -> setValue('tanggal_perceraian',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perceraian)));
          $docx -> setValue('status_hubungan_dalam_keluarga',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga);
          $docx -> setValue('cacat',$data_penduduks[0]->Cacat);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('nama_ibu',$data_penduduks[0]->Nama_Ibu);
          $docx -> setValue('nik_ibu',$data_penduduks[0]->NIK_Ibu);
          $docx -> setValue('nama_ayah',$data_penduduks[0]->Nama_Ayah);
          $docx -> setValue('nik_ayah',$data_penduduks[0]->NIK_Ayah);


          
          
          
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_bio_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('no_passpor',$data_penduduks[0]->No_Passpor);
          $docx -> setValue('tanggal_akhir_passpor',$data_penduduks[0]->Tanggal_akhir_Paspor);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('akta_lahir',$data_penduduks[0]->Akta_Lahir);
          $docx -> setValue('gol_darah',$data_penduduks[0]->Golongan_Darah);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('no_akta_perkawinan',$data_penduduks[0]->No_Akta_Perkawinan);
          $docx -> setValue('tanggal_perkawinan',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perkawinan)));
          $docx -> setValue('no_akta_perceraian',$data_penduduks[0]->No_Akta_Perceraian);
          $docx -> setValue('tanggal_perceraian',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Perceraian)));
          $docx -> setValue('status_hubungan_dalam_keluarga',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga);
          $docx -> setValue('cacat',$data_penduduks[0]->Cacat);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('nama_ibu',$data_penduduks[0]->Nama_Ibu);
          $docx -> setValue('nik_ibu',$data_penduduks[0]->NIK_Ibu);
          $docx -> setValue('nama_ayah',$data_penduduks[0]->Nama_Ayah);
          $docx -> setValue('nik_ayah',$data_penduduks[0]->NIK_Ayah);


          
          
          
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_domisili_usaha_non_warga_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_domisili_usaha_non_warga_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_kayu_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_kayu_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_izin_pengangkutan_tanah_urug_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->No_KK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          

          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_beda_identitas_kis_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_beda_identitas_kis_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_beda_nama_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_beda_nama_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_catatan_kriminal_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_catatan_kriminal_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_cerai_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_cerai_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_domisili_usaha_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_domisili_usaha_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_harga_tanah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_harga_tanah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_jamkesos_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_jamkesos_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kehilangan_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kehilangan_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_jual_beli_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_jual_beli_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kelakuan_baik_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kelakuan_baik_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('pendidikan',$data_penduduks[0]->pendidikan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_kendaraan_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_tanah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kepemilikan_tanah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kurang_mampu_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_kurang_mampu_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_luar_daerah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_luar_daerah_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_luar_negeri_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_luar_negeri_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('no_kk',$data_penduduks[0]->Nomor_KK);
          $docx -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_penduduk_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_tidak_memiliki_jamkesos_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('status_perkawinan',$data_penduduks[0]->status_perkawinan);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_usaha_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_usaha_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_yatim_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

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
          $hasil   = public_path('storage/surat/surat_ket_yatim_.doc');
          $phpWord = new PhpWord();

          $docx   = $phpWord->loadTemplate($file);

          
          $docx -> setValue('nama_kabupaten',$kopsurats[0]->Nama_Kabupaten);
          $docx -> setValue('nama_kecamatan',$kopsurats[0]->Nama_Kecamatan);
          $docx -> setValue('nama_desa',$kopsurats[0]->Nama_Desa);
          $docx -> setValue('alamat_desa',$kopsurats[0]->Alamat_Desa);
          $docx -> setValue('tahun',$mytime->year);
          $docx -> setValue('nama',$data_penduduks[0]->Nama);
          $docx -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $docx -> setValue('tempat_lahir',$data_penduduks[0]->Tempat_Lahir);
          $docx -> setValue('tanggal_lahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $docx -> setValue('jenis_kelamin',$data_penduduks[0]->jenis_kelamin);
          $docx -> setValue('agama',$data_penduduks[0]->agama);
          $docx -> setValue('umur',$data_penduduks[0]->Usia);
          $docx -> setValue('warganegara',$data_penduduks[0]->Kewarganegaraan);
          $docx -> setValue('pekerjaan',$data_penduduks[0]->jenis_pekerjaan);
          $docx -> setValue('alamat',$data_penduduks[0]->Alamat);
          $docx -> setValue('rt',$data_penduduks[0]->RT);
          $docx -> setValue('rw',$data_penduduks[0]->RW);
          if($kode_area_dusuns->count()==0){
            $docx -> setValue('dusun',"-");

          }else{
            $docx -> setValue('dusun',$kode_area_dusuns[0]->Nama_Dusun);
          }
          
          $docx -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $docx -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }




}
