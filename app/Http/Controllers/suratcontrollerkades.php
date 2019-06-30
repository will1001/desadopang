<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;	
use PhpOffice\PhpWord\PhpWord;
use App\data_penduduk;
use App\kode_area_dusun;
use Carbon;

class suratcontrollerkades extends Controller
{
    //

    public function surat_ket_domisili_kades($NIK)
    {

        if(Auth::user()->roles == "kades"){

          $data_penduduks=data_penduduk::where('NIK',$NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          $mytime = Carbon\Carbon::now();
        
          $file   = public_path('storage/surat/surat_ket_domisili.docx');
          $hasil   = public_path('storage/surat/surat_ket_domisili_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('no_KK',$data_penduduks[0]->Nomor_KK);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->Jenis_Kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->Agama);
          $doc -> setValue('status_perkawinan',$data_penduduks[0]->Status_Perkawinan);
          $doc -> setValue('pendidikan',$data_penduduks[0]->Pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->Jenis_Pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->Kewarganegaraan);
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




    public function surat_ket_pindah_penduduk_kades($NIK)
    {

        if(Auth::user()->roles == "kades"){

        
          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
  

          $mytime = Carbon\Carbon::now();

        
          $file   = public_path('storage/surat/surat_ket_pindah_penduduk.docx');
          $hasil   = public_path('storage/surat/surat_ket_pindah_penduduk_.docx');
          $phpWord = new PhpWord();

          $doc   = $phpWord->loadTemplate($file);

          
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('kepala_kk',$data_penduduks[0]->Kepala_Keluarga);  
          $doc -> setValue('nama',$data_penduduks[0]->Nama);
          $doc -> setValue('no_ktp',$data_penduduks[0]->NIK);
          $doc -> setValue('tempatlahir',$data_penduduks[0]->Tempat_Lahir);
          $doc -> setValue('tanggallahir',date("d-m-Y", strtotime($data_penduduks[0]->Tanggal_Lahir)));
          $doc -> setValue('umur',$data_penduduks[0]->Usia);
          $doc -> setValue('jenis_kelamin',$data_penduduks[0]->Jenis_Kelamin);
          $doc -> setValue('agama',$data_penduduks[0]->Agama);
          $doc -> setValue('pendidikan',$data_penduduks[0]->Pendidikan);
          $doc -> setValue('pekerjaan',$data_penduduks[0]->Jenis_Pekerjaan);
          $doc -> setValue('kewarganegaraan',$data_penduduks[0]->Kewarganegaraan);
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


     

    

    public function surat_izin_keramaian_kades()
    {

        if(Auth::user()->roles == "kades"){

          // Surat izin keramaian

        
          $file   = public_path('storage/surat/nikah/surat_izin_keramaian.docx');
          $hasil   = public_path('storage/surat/nikah/surat_izin_keramaian_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
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

    public function surat_kehendak_nikah_kades()
    {

        if(Auth::user()->roles == "kades"){

        

          // surat kehendak nikah
          $file   = public_path('storage/surat/nikah/surat_kehendak_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_kehendak_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          
          
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_nikah_kades($NIK)
    {

        if(Auth::user()->roles == "kades"){

        

          // surat keterangan nikah

          $file   = public_path('storage/surat/nikah/surat_ket_nikah.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_nikah_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          
          
          
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);

        


        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali_kades()
    {

        if(Auth::user()->roles == "kades"){

        
          // Surat keterangan Wali
          $file   = public_path('storage/surat/nikah/surat_ket_wali.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
        



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_ket_wali_hakim_kades()
    {

        if(Auth::user()->roles == "kades"){

         
          // Surat keterangan Wali hakim
           $file   = public_path('storage/surat/nikah/surat_ket_wali_hakim.docx');
          $hasil   = public_path('storage/surat/nikah/surat_ket_wali_hakim_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('tahun',$mytime->year);
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);
          



        }else{
            
            return redirect('admin');
        }
    
    }

    public function surat_persetujuan_mempelai_kades()
    {

        if(Auth::user()->roles == "kades"){

        
          // Surat Persetujuan mempelai
          $file   = public_path('storage/surat/nikah/surat_persetujuan_mempelai.docx');
          $hasil   = public_path('storage/surat/nikah/surat_persetujuan_mempelai_.docx');
          $phpWord = new PhpWord();

          $data_penduduks=data_penduduk::where('NIK',Auth::user()->NIK)->get();
          $kode_area_dusuns=kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();

          
          
          

          $mytime = Carbon\Carbon::now();

          $doc   = $phpWord->loadTemplate($file);
          $mytime = Carbon\Carbon::now();
          $doc -> setValue('tgl_surat',date("d-m-Y", strtotime($mytime->toDateTimeString())));
          $doc -> saveAs($hasil);

          return response()->download($hasil)->deleteFileAfterSend(true);



        }else{
            
            return redirect('admin');
        }
    
    }
}
