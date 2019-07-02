<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\apbd;
use App\rkp;
use App\rpjm;
use App\barangdesa;
use App\berita;
use App\pengumumandesa;
use App\SOTK;
use App\User;
use App\bumdes;
use App\profil_desa;
use App\statistik_desa;
use App\data_penduduk;
use Artisan;

class webcontroller extends Controller
{
    //

    public function export_data_penduduk() 
    {
        return Excel::download(new UsersExport, 'Data Penduduk.xlsx');
    }

    public function bumdes()
    {
        # code...
        $bumdess= profil_desa::all();
        return view("bumdes",['bumdess' => $bumdess]);
    } 

    public function kktidakada()
    {
        # code...
        
        return view("kktidakada");
    } 

     public function profildesadopang()
    {
        # code...
        $profil_desas= profil_desa::all();
        return view("profildesadopang",['profil_desas' => $profil_desas]);
    } 



    public function indexberita()
    {
        # code...
        $beritas= berita::orderBy("created_at","desc")->take(3)->skip(0)->get();
        return view("indexberita",['beritas' => $beritas]);
    } 

    public function indextransparansi()
    {
        # code...
        
        return view("indextransparansi");
    } 


    public function indexproduk()
    {
        # code...
        
        return view("indexproduk");
    } 









    public function statistik()
    {
        # code...
        // $statistik_desas= statistik_desa::all();
        // $data_penduduks= data_penduduk::all();
        $jml_penduduk_L=data_penduduk::where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_P=data_penduduk::where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_TEMILING_L=data_penduduk::where('Id_Dusun','=','1')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_TEMILING_P=data_penduduk::where('Id_Dusun','=','1')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_DALAM_DESA_UTARA_L=data_penduduk::where('Id_Dusun','=','2')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_DALAM_DESA_UTARA_P=data_penduduk::where('Id_Dusun','=','2')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_DALAM_DESA_SELATAN_L=data_penduduk::where('Id_Dusun','=','3')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_DALAM_DESA_SELATAN_P=data_penduduk::where('Id_Dusun','=','3')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_KAYULIAN_L=data_penduduk::where('Id_Dusun','=','4')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_KAYULIAN_P=data_penduduk::where('Id_Dusun','=','4')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_DASAN_BARU_L=data_penduduk::where('Id_Dusun','=','5')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_DASAN_BARU_P=data_penduduk::where('Id_Dusun','=','5')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_dusun_PENGEMBUR_L=data_penduduk::where('Id_Dusun','=','6')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_dusun_PENGEMBUR_P=data_penduduk::where('Id_Dusun','=','6')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_tidak_sekolah_L=data_penduduk::where('Pendidikan','=','1')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_tidak_sekolah_P=data_penduduk::where('Pendidikan','=','1')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_blm_sd_L=data_penduduk::where('Pendidikan','=','2')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_blm_sd_P=data_penduduk::where('Pendidikan','=','2')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_tamat_sd_L=data_penduduk::where('Pendidikan','=','3')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_tamat_sd_P=data_penduduk::where('Pendidikan','=','3')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_smp_L=data_penduduk::where('Pendidikan','=','4')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_smp_P=data_penduduk::where('Pendidikan','=','4')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_sma_L=data_penduduk::where('Pendidikan','=','5')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_sma_P=data_penduduk::where('Pendidikan','=','5')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_d1_L=data_penduduk::where('Pendidikan','=','6')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_d1_P=data_penduduk::where('Pendidikan','=','6')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_d3_L=data_penduduk::where('Pendidikan','=','7')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_d3_P=data_penduduk::where('Pendidikan','=','7')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_s1_L=data_penduduk::where('Pendidikan','=','8')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_s1_P=data_penduduk::where('Pendidikan','=','8')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_s2_L=data_penduduk::where('Pendidikan','=','9')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_s2_P=data_penduduk::where('Pendidikan','=','9')->where('Jenis_Kelamin','=','2')->count();
        $jml_penduduk_s3_L=data_penduduk::where('Pendidikan','=','10')->where('Jenis_Kelamin','=','1')->count();
        $jml_penduduk_s3_P=data_penduduk::where('Pendidikan','=','10')->where('Jenis_Kelamin','=','2')->count();


        return view("statistik",
            [
                'jml_penduduk_L' => $jml_penduduk_L,
                'jml_penduduk_P' => $jml_penduduk_P,
                'jml_penduduk_dusun_TEMILING_L' => $jml_penduduk_dusun_TEMILING_L,
                'jml_penduduk_dusun_TEMILING_P' => $jml_penduduk_dusun_TEMILING_P,
                'jml_penduduk_dusun_DALAM_DESA_UTARA_L' => $jml_penduduk_dusun_DALAM_DESA_UTARA_L,
                'jml_penduduk_dusun_DALAM_DESA_UTARA_P' => $jml_penduduk_dusun_DALAM_DESA_UTARA_P,
                'jml_penduduk_dusun_DALAM_DESA_SELATAN_L' => $jml_penduduk_dusun_DALAM_DESA_SELATAN_L,
                'jml_penduduk_dusun_DALAM_DESA_SELATAN_P' => $jml_penduduk_dusun_DALAM_DESA_SELATAN_P,
                'jml_penduduk_dusun_KAYULIAN_L' => $jml_penduduk_dusun_KAYULIAN_L,
                'jml_penduduk_dusun_KAYULIAN_P' => $jml_penduduk_dusun_KAYULIAN_P,
                'jml_penduduk_dusun_DASAN_BARU_L' => $jml_penduduk_dusun_DASAN_BARU_L,
                'jml_penduduk_dusun_DASAN_BARU_P' => $jml_penduduk_dusun_DASAN_BARU_P,
                'jml_penduduk_dusun_PENGEMBUR_L' => $jml_penduduk_dusun_PENGEMBUR_L,
                'jml_penduduk_dusun_PENGEMBUR_P' => $jml_penduduk_dusun_PENGEMBUR_P,
                'jml_penduduk_tidak_sekolah_L' => $jml_penduduk_tidak_sekolah_L,
                'jml_penduduk_tidak_sekolah_P' => $jml_penduduk_tidak_sekolah_P,
                'jml_penduduk_blm_sd_L' => $jml_penduduk_blm_sd_L,
                'jml_penduduk_blm_sd_P' => $jml_penduduk_blm_sd_P,
                'jml_penduduk_tamat_sd_L' => $jml_penduduk_tamat_sd_L,
                'jml_penduduk_tamat_sd_P' => $jml_penduduk_tamat_sd_P,
                'jml_penduduk_smp_L' => $jml_penduduk_smp_L,
                'jml_penduduk_smp_P' => $jml_penduduk_smp_P,
                'jml_penduduk_sma_L' => $jml_penduduk_sma_L,
                'jml_penduduk_sma_P' => $jml_penduduk_sma_P,
                'jml_penduduk_d1_L' => $jml_penduduk_d1_L,
                'jml_penduduk_d1_P' => $jml_penduduk_d1_P,
                'jml_penduduk_d3_L' => $jml_penduduk_d3_L,
                'jml_penduduk_d3_P' => $jml_penduduk_d3_P,
                'jml_penduduk_s1_L' => $jml_penduduk_s1_L,
                'jml_penduduk_s1_P' => $jml_penduduk_s1_P,
                'jml_penduduk_s2_L' => $jml_penduduk_s2_L,
                'jml_penduduk_s2_P' => $jml_penduduk_s2_P,
                'jml_penduduk_s3_L' => $jml_penduduk_s3_L,
                'jml_penduduk_s3_P' => $jml_penduduk_s3_P,
            ]);
    } 


    public function profildesa()
    {
        # code...
        $profil_desas= profil_desa::all();
        return view("profildesa",['profil_desas' => $profil_desas]);
    } 

    public function profildesadaftar()
    {
        # code...
        return view("profildesadaftar");
    } 


    public function artisancall()
    {
        Artisan::call("storage:link");
    }
    public function organisasi()
    {
        # code...
        $SOTK['SOTKs']=SOTK::all();
        return view("organisasi",$SOTK);
    }


    public function karangtaruna()
    {
        # code...
        return view("karangtaruna");
    }  


    public function BPD()
    {
        # code...
        return view("BPD");
    }  


    public function LPMD()
    {
        # code...
        return view("LPMD");
    }  

    public function SOTK()
    {
        # code...
        
        $SOTKs= SOTK::all();
        return view("SOTK",['SOTKs' => $SOTKs]);
    }


    public function indexhome()
    {
       $beritas= berita::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $beritas2= berita::orderBy("created_at","desc")->take(2)->skip(3)->get();
       $beritas3= berita::orderBy("created_at","desc")->take(2)->skip(5)->get();
       $pengumumans= pengumumandesa::orderBy("created_at","desc")->take(3)->get();
       $SOTKs= SOTK::all();
       $barangdesas = barangdesa::orderBy("created_at","desc")->take(4)->get();
       $barangdesas2 = barangdesa::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $barangdesas3 = barangdesa::orderBy("created_at","desc")->take(4)->skip(8)->get();
       $bumdess = bumdes::orderBy("created_at","desc")->take(4)->get();
       $bumdess2 = bumdes::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $bumdess3 = bumdes::orderBy("created_at","desc")->take(4)->skip(8)->get();

       return view('indexhome', ['beritas' => $beritas,'beritas2' => $beritas2,'beritas3' => $beritas3, 'pengumumans' => $pengumumans, 'SOTKs' => $SOTKs, 'barangdesas' => $barangdesas, 'barangdesas2' => $barangdesas2, 'barangdesas3' => $barangdesas3,'bumdess' => $bumdess,'bumdess2' => $bumdess2,'bumdess3' => $bumdess3]);
    }


    public function beritadesa()
    {
        # code...
        $beritas = berita::orderBy("created_at","desc")->paginate(5);
        return view('beritadesa',['beritas' => $beritas]);
    }

    public function pengumumandesa()
    {
        # code...
        $pengumumans= pengumumandesa::paginate(5);

        return view('pengumumandesa', ['pengumumans' => $pengumumans]);
    }  

    public function detailberitadesa($id)
    {
        # code...
        $beritas=berita::where('judulberita', '=', $id)->first();
        return view("detailberita",['beritas' => $beritas]);
    }

    public function detailpengumuman($id)
    {
        # code...
        $pengumumans=pengumumandesa::where('judulpengumuman', '=', $id)->first();
        return view("detailpengumuman",['pengumumans' => $pengumumans]);

    } 


    public function barangdesa()
    {
        # code...
        $barangdesas = barangdesa::orderBy('created_at', 'desc')->paginate(30);
        return view('barangdesa',['barangdesas' => $barangdesas]);
    }


    public function caribarangdesa(Request $request)
    {
    	# code...
        $barangdesas = barangdesa::where('nama','LIKE','%'.$request->search.'%')->get();
    	return view('barangdesa',['barangdesas' => $barangdesas]);
    }

    public function detailbarangdesa($id)
    {
        # code...
        $barangdesas= barangdesa::find($id);
        $users= User::find($barangdesas->id_pemilik);
        $data_penduduks= data_penduduk::where('Nomor_KK',$users->Nomor_KK)->get();
        

        
        return view('detailbarangdesa',['barangdesas' => $barangdesas,'users' => $users,'data_penduduks' => $data_penduduks]);
    }

    public function detailbumdes($id)
    {
    	# code...
        $bumdes= bumdes::find($id);
        

    	
    	return view('detailbumdes',['bumdes' => $bumdes]);
    }

    public function transparansi($id)
    {
        # code...
        switch ($id) {
        case 'apbd':

            $apbds =apbd::all();
            return view('transparansi', ['apbds' => $apbds], ['id' => $id]);

            break;

        case 'rkp':

            $apbds =rkp::all();
            return view('transparansi', ['apbds' => $apbds], ['id' => $id]);

            
            break;

        case 'rpjm':

             $apbds =rpjm::all();
             return view('transparansi', ['apbds' => $apbds], ['id' => $id]);

            
        break;
    }
        
    }


    public function reloadtabeldatapendudukajax(Request $request)
    {
        if($request->ajax()){
        $data_penduduk_kadus_ajax=App\data_penduduk::where('id_dusun',$id)->take(25)->skip($skipdata)->get();

        
        //return Response::json($data_penduduk_kadus_ajax);
        return Response("oke");
    }

    }

}
