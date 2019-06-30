<?php

namespace App\Http\Controllers;

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

    public function bumdes()
    {
        # code...
        $bumdess= bumdes::all();
        return view("bumdes",['bumdess' => $bumdess]);
    } 


    public function statistik()
    {
        # code...
        $statistik_desas= statistik_desa::all();
        return view("statistik",['statistik_desas' => $statistik_desas]);
    } 


    public function profildesa()
    {
        # code...
        $profil_desas= profil_desa::all();
        return view("profildesa",['profil_desas' => $profil_desas]);
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
       $pengumumans= pengumumandesa::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $SOTKs= SOTK::all();
       $barangdesas = barangdesa::orderBy("created_at","desc")->take(4)->get();
       $barangdesas2 = barangdesa::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $barangdesas3 = barangdesa::orderBy("created_at","desc")->take(4)->skip(8)->get();

       return view('indexhome', ['beritas' => $beritas,'beritas2' => $beritas2,'beritas3' => $beritas3, 'pengumumans' => $pengumumans, 'SOTKs' => $SOTKs, 'barangdesas' => $barangdesas, 'barangdesas2' => $barangdesas2, 'barangdesas3' => $barangdesas3]);
    }

    public function indexberita()
    {
       $beritas= berita::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $beritas2= berita::orderBy("created_at","desc")->take(2)->skip(3)->get();
       $beritas3= berita::orderBy("created_at","desc")->take(2)->skip(5)->get();
       $pengumumans= pengumumandesa::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $SOTKs= SOTK::all();
       $barangdesas = barangdesa::orderBy("created_at","desc")->take(4)->get();
       $barangdesas2 = barangdesa::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $barangdesas3 = barangdesa::orderBy("created_at","desc")->take(4)->skip(8)->get();

       return view('indexberita', ['beritas' => $beritas,'beritas2' => $beritas2,'beritas3' => $beritas3, 'pengumumans' => $pengumumans, 'SOTKs' => $SOTKs, 'barangdesas' => $barangdesas, 'barangdesas2' => $barangdesas2, 'barangdesas3' => $barangdesas3]);
    }

    public function indextransparansi()
    {
       $beritas= berita::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $beritas2= berita::orderBy("created_at","desc")->take(2)->skip(3)->get();
       $beritas3= berita::orderBy("created_at","desc")->take(2)->skip(5)->get();
       $pengumumans= pengumumandesa::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $SOTKs= SOTK::all();
       $barangdesas = barangdesa::orderBy("created_at","desc")->take(4)->get();
       $barangdesas2 = barangdesa::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $barangdesas3 = barangdesa::orderBy("created_at","desc")->take(4)->skip(8)->get();

       return view('indextransparansi', ['beritas' => $beritas,'beritas2' => $beritas2,'beritas3' => $beritas3, 'pengumumans' => $pengumumans, 'SOTKs' => $SOTKs, 'barangdesas' => $barangdesas, 'barangdesas2' => $barangdesas2, 'barangdesas3' => $barangdesas3]);
    }

    public function indexproduk()
    {
       $beritas= berita::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $beritas2= berita::orderBy("created_at","desc")->take(2)->skip(3)->get();
       $beritas3= berita::orderBy("created_at","desc")->take(2)->skip(5)->get();
       $pengumumans= pengumumandesa::orderBy("created_at","desc")->take(3)->skip(0)->get();
       $SOTKs= SOTK::all();
       $barangdesas = barangdesa::orderBy("created_at","desc")->take(4)->get();
       $barangdesas2 = barangdesa::orderBy("created_at","desc")->take(4)->skip(4)->get();
       $barangdesas3 = barangdesa::orderBy("created_at","desc")->take(4)->skip(8)->get();

       return view('indexproduk', ['beritas' => $beritas,'beritas2' => $beritas2,'beritas3' => $beritas3, 'pengumumans' => $pengumumans, 'SOTKs' => $SOTKs, 'barangdesas' => $barangdesas, 'barangdesas2' => $barangdesas2, 'barangdesas3' => $barangdesas3]);
    }


    public function beritadesa()
    {
        # code...
        $beritas = berita::paginate(5);
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
        $barangdesas = barangdesa::paginate(30);
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
        $data_penduduks= data_penduduk::where('NIK',$users->NIK)->get();
        

    	
    	return view('detailbarangdesa',['barangdesas' => $barangdesas,'users' => $users,'data_penduduks' => $data_penduduks]);
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
