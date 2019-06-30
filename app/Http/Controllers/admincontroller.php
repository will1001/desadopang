<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon;
use App\user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\apbd;
use App\rkp;
use App\rpjm;
use App\berita;
use App\pengumumandesa;
use App\jmlpend;
use App\statagamapend;
use App\statetnispend;
use App\statpendidikanpend;
use App\statpekerjaanpend;
use App\barangdesa;
use App\bumdes;
use App\SOTK;
use App\profil_desa;
use App\statistik_desa;
use App\kode_area_dusun;
use App\data_penduduk;
use App\kopsurat;
use App\tabel_agama;
use App\tabel_golongan_darah;
use App\tabel_jenis_pekerjaan;
use App\tabel_kewarganegaraan;
use App\tabel_pendidikan;
use App\tabel_status_perkawinan;
use App\tabel_jenis_kelamin;
use App\tabel_status_hubungan_dalam_keluarga;
use App\kode_data_akta_lahir;
use App\kode_data_cacat;
use App\kode_data_cara_kb;
use Validator;
use PhpOffice\PhpWord\PhpWord;

class admincontroller extends Controller
{
    



    public function formuploadapbd($id)
    {
        if(Auth::user()->roles == "kades"){
        
        return view("adminCRUD/uploadAPBD",['id'=>$id]);
        }else{
            
            return redirect('admin');
        }

    }

    public function formuploadprofildesa()
    {
        if(Auth::user()->roles == "kades"){
        
        return view("adminCRUD/uploadprofildesa");
        }else{
            
            return redirect('admin');
        }

    }

    public function formuploadstatistikdesa()
    {
        if(Auth::user()->roles == "kades"){
        
        return view("adminCRUD/uploadstatistikdesa");
        }else{
            
            return redirect('admin');
        }

    }


    public function uploadprofildesa(Request $request)
    {
        if(Auth::user()->roles == "kades"){
        
        $filesebelumnya = profil_desa::all();
        foreach ($filesebelumnya as $value) {
            # code...
            File::delete('/uploadsgambar/'.basename($value->urlgambar));
        }
        profil_desa::truncate();
        if($request->hasfile('url_gambar')){
            
            foreach($request->file('url_gambar') as $image)
            {

                    
                    $data = new profil_desa();
                    $fileName = $image->getClientOriginalName();
                    $path = public_path().'/uploadsgambar';
                    $upload = $image->move($path,$fileName);
                    $data->urlgambar ='/uploadsgambar/'.$fileName;
                    $data->save();
            }


            

              $var="data berhasil di simpan";
                     return redirect('admin')->with('key', $var);
        }else{
            
            return redirect('adminCRUD/formuploadAPBD')->with('message', 'Tolong upload gambar');
        }
        }else{
            
            return redirect('admin');
        }

    }

    public function uploadstatistikdesa(Request $request)
    {
        if(Auth::user()->roles == "kades"){
        
        $filesebelumnya = statistik_desa::all();
        foreach ($filesebelumnya as $value) {
            # code...
            File::delete('/uploadsgambar/'.basename($value->urlgambar));
        }
        statistik_desa::truncate();
        if($request->hasfile('url_gambar')){
            
            foreach($request->file('url_gambar') as $image)
            {

                    
                    $data = new statistik_desa();
                    $fileName = $image->getClientOriginalName();
                    $path = public_path().'/uploadsgambar';
                    $upload = $image->move($path,$fileName);
                    $data->urlgambar ='/uploadsgambar/'.$fileName;
                    $data->save();
            }


            

              $var="data berhasil di simpan";
                     return redirect('admin')->with('key', $var);
        }else{
            
            return redirect('adminCRUD/formuploadAPBD')->with('message', 'Tolong upload gambar');
        }
        }else{
            
            return redirect('admin');
        }

    }



    public function uploadapbd(Request $request,$id)
    {

        if(Auth::user()->roles == "kades"){
        

        switch ($id) {
        case 'apbd':
        $filesebelumnya = apbd::all();
        foreach ($filesebelumnya as $value) {
            # code...
            File::delete('/uploadsgambar/'.basename($value->urlgambar));
        }
        apbd::truncate();
        if($request->hasfile('url_gambar')){
            
            foreach($request->file('url_gambar') as $image)
            {

                    
                    $data = new apbd();
                    $data->tahun = $request->tahunapbd;
                    $fileName = $image->getClientOriginalName();
                    $path = public_path().'/uploadsgambar';
                    $upload = $image->move($path,$fileName);
                    $data->urlgambar ='/uploadsgambar/'.$fileName;
                    $data->save();
            }


            

              $var="data berhasil di simpan";
                     return redirect('admin')->with('key', $var);
        }else{
            
            return redirect('adminCRUD/formuploadAPBD')->with('message', 'Tolong upload gambar');
        }
        
            break;

        case 'rkp':
        $filesebelumnya = rkp::all();
        foreach ($filesebelumnya as $value) {
            # code...
            File::delete('/uploadsgambar/'.basename($value->urlgambar));
        }
        rkp::truncate();
        if($request->hasfile('url_gambar')){
            
            foreach($request->file('url_gambar') as $image)
            {

                    $data = new rkp();
                    $data->tahun = $request->tahunapbd;
                    $fileName = $image->getClientOriginalName();
                    $path = public_path().'/uploadsgambar';
                    $upload = $image->move($path,$fileName);
                    $data->urlgambar ='/uploadsgambar/'.$fileName;
                    $data->save();
            }

                     return redirect('admin');    
        }else{
            
            return redirect('adminCRUD/formuploadAPBD')->with('message', 'Tolong upload gambar');;
        }
    
        
            break; 

        case 'rpjm':
        $filesebelumnya = rpjm::all();
        foreach ($filesebelumnya as $value) {
            # code...
            File::delete('/uploadsgambar/'.basename($value->urlgambar));
        }

        rpjm::truncate();
        if($request->hasfile('url_gambar')){
            
            foreach($request->file('url_gambar') as $image)
            {

                    $data = new rpjm();
                    $data->tahun = $request->tahunapbd;
                    $fileName = $image->getClientOriginalName();
                    $path = public_path().'/uploadsgambar';
                    $upload = $image->move($path,$fileName);
                    $data->urlgambar ='/uploadsgambar/'.$fileName;
                    $data->save();
            }


            
                     return redirect('admin');
        }else{
            
            return redirect('adminCRUD/formuploadAPBD')->with('message', 'Tolong upload gambar');;
        }
         
            break;

      }
    }else{
            
            return redirect('admin');
        }
        
    } 


    public function formaddbarangdesa($id)
    {
        if(Auth::user()->roles == "member"){
        
        if($id<10){
            return view('adminCRUD/addbarangdesa');
        }else{
            return redirect()->back()->with('batas', 'Maaf Anda sudah mencapai batas maksimal barang yang bisa di jual');
        }
        
    }else{
        
        return redirect('admin');
    }

    }

    public function formaddbumdes($id)
    {
        if(Auth::user()->roles == "kades"){
        
        if($id<10){
            return view('adminCRUD/addbumdes');
        }else{
            return redirect()->back()->with('batas', 'Maaf Anda sudah mencapai batas maksimal barang yang bisa di jual');
        }
        
    }else{
        
        return redirect('admin');
    }

    }


    public function formaddberita()
    {
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addberita');
    }else{
        
        return redirect('admin');
    }

    }
 

 	public function formaddpengumuman()
    {
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addpengumuman');
    }else{
        
        return redirect('admin');
    }

    }


     public function formaddjmlpend()
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addjmlpend');
    }else{
        
        return redirect('admin');
    }

    }


    public function formaddstatpendidikanpend()
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addstatpendidikanpend');
    }else{
        
        return redirect('admin');
    }
    }

    public function formaddstatpekerjaanpend()
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addstatpekerjaanpend');
    }else{
        
        return redirect('admin');
    }
    }

    public function formaddstatetnispend()
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addstatetnispend');
    }else{
        
        return redirect('admin');
    }
    }

    public function formaddstatagamapend()
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        return view('adminCRUD/addstatagamapend');
    }else{
        
        return redirect('admin');
    }
    }


    public function formeditbarangdesa($id)
    {
        # code...
        if(Auth::user()->roles == "member"){
        
        $barangdesas=barangdesa::find($id);
        return view('adminCRUD/editbarangdesa',['barangdesas' => $barangdesas]);
        }else{
        
            return redirect('admin');
        }
        
    }

    public function formeditbumdes($id)
    {
        # code...
        if(Auth::user()->roles == "kades"){
        
        $bumdess=bumdes::find($id);
        return view('adminCRUD/editbumdes',['bumdess' => $bumdess]);
        }else{
        
            return redirect('admin');
        }
        
    }



    public function formeditberita($id)
    {
        # code...
        if(Auth::user()->roles == "kades"){
        
        $beritas=berita::find($id);
        return view('adminCRUD/editberita',['beritas' => $beritas]);
        }else{
        
            return redirect('admin');
        }
        
    }


        public function formeditpengumuman($id)
            {
                # code...
                if(Auth::user()->roles == "kades"){
                
                $pengumumans=pengumumandesa::find($id);
                return view('adminCRUD/editpengumuman',['pengumumans' => $pengumumans]);
                }else{
                
                    return redirect('admin');
                }
                
            }

        public function formeditjmlpend($id)
            {
            	# code...
                if(Auth::user()->roles == "kades"){
                
                $jmlpends=jmlpend::find($id);
                return view('adminCRUD/editjmlpend',['jmlpends' => $jmlpends]);
                }else{
                
                    return redirect('admin');
                }
                
            }

    public function formeditstatpendidikanpend($id)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        $pendidikans=statpendidikanpend::find($id);
        return view('adminCRUD/editstatpendidikanpend',['pendidikans' => $pendidikans]);
        }else{
        
            return redirect('admin');
        }
    }

    public function formeditstatpekerjaanpend($id)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        $pekerjaans=statpekerjaanpend::find($id);
        return view('adminCRUD/editstatpekerjaanpend',['pekerjaans' => $pekerjaans]);
        }else{
        
            return redirect('admin');
        }


        

    }

    public function formeditstatetnispend($id)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        $etniss=statetnispend::find($id);
        return view('adminCRUD/editstatetnispend',['etniss' => $etniss]);
        }else{
        
            return redirect('admin');
        }
    }

    public function formeditstatagamapend($id)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
        
        $agamas=statagamapend::find($id);
        return view('adminCRUD/editstatagamapend',['agamas' => $agamas]);
        }else{
        
            return redirect('admin');
        }

    }

    public function formeditSOTK($id)
    {
        if(Auth::user()->roles == "kades"){
        $SOTKs=sotk::find($id);
        return view('adminCRUD/editSOTK',['SOTKs' => $SOTKs]);
    }else{
        
        return redirect('admin');
    }

    }

    public function formaddSOTK()
    {
        if(Auth::user()->roles == "kades"){
        return view('adminCRUD/addSOTK');
    }else{
        
        return redirect('admin');
    }

    }

    public function deleteSOTK($id)
    {
        # code...

        if(Auth::user()->roles == "kades"){
        
        sotk::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di hapus');
        }else{
        
            return redirect('admin');
        }


    }


public function addSOTK(Request $request)
    {


        if(Auth::user()->roles == "kades"){
            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            if($request->hasfile('url_gambar')){

           
                       
            $data = new sotk();
            $data->Nama = $request->Nama;
            $data->Jabatan = $request->Jabatan;
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            $data->urlgambar ='/uploadsgambar/'.$fileName;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

            }else{
               
                return redirect('formeditpengumuman')->with('message', 'Tolong upload gambar');
            }

        }else{
        
            return redirect('admin');
        }


    }


    public function editSOTK(Request $request,$id)
    {


        if(Auth::user()->roles == "kades"){
            if($request->hasfile('urlgambar')){

            $validator = Validator::make(request()->all(), [
                'urlgambar' => 'required|image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            $filesebelumnya = SOTK::find($id);
            File::delete('storage/'.basename($filesebelumnya->urlgambar));
           
            
            $fileName = $request->urlgambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->urlgambar->move($path,$fileName);
            SOTK::find($id)->update([
            'Nama' => $request->Nama,
            'Jabatan' => $request->Jabatan,
            'urlgambar' => '/uploadsgambar/'.$fileName
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');

            }else{
               
                SOTK::find($id)->update([
            'Nama' => $request->Nama,
            'Jabatan' => $request->Jabatan,
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');
            }

        }else{
        
            return redirect('admin');
        }


    }



    public function addbarangdesa(Request $request)
    {


        if(Auth::user()->roles == "member"){
             $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            if($request->hasfile('url_gambar')){

           
                       
            $data = new barangdesa();
            $data->nama = $request->nama_barang;
            $data->harga = $request->harga;
            $data->jumlah = $request->jumlah;
            $data->kategori = $request->get('kategori');
            $data->id_pemilik = Auth::user()->id;
            $data->deskripsi = $request->deskripsi_barang;
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            $data->urlgambar ='/uploadsgambar/'.$fileName;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            
            $data = new barangdesa();
            $data->nama = $request->nama_barang;
            $data->harga = $request->harga;
            $data->jumlah = $request->jumlah;
            $data->kategori = $request->get('kategori');
            $data->id_pemilik = Auth::user()->id;
            $data->deskripsi = $request->deskripsi_barang;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }
        
        
        }else{
        
            return redirect('admin');
        }

    }

    public function addbumdes(Request $request)
    {


        if(Auth::user()->roles == "kades"){
             $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            if($request->hasfile('url_gambar')){

           
                       
            $data = new bumdes();
            $data->nama = $request->nama_barang;
            $data->harga = $request->harga;
            $data->jumlah = $request->jumlah;
            $data->id_pemilik = Auth::user()->id;
            $data->deskripsi = $request->deskripsi_barang;
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            $data->urlgambar ='/uploadsgambar/'.$fileName;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('formaddbumdes')->with('message', 'Tolong upload gambar');

        }
        
        
        }else{
        
            return redirect('admin');
        }

    }



      public function addberita(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            if($request->hasfile('url_gambar')){

            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }
            
            if($request->urlvideo != null){
                $video_id = explode("?v=", $request->urlvideo);
                $video_id = substr($video_id[1],0,11);
            }else{
                $video_id=null;
            }
            $data = new berita();
            $data->judulberita = $request->judul_berita;
            $data->deskripsi = $request->isi_berita;
            $data->urlvideo = $video_id;
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            $data->urlgambar ='/uploadsgambar/'.$fileName;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            
            if($request->urlvideo != null){
                $video_id = explode("?v=", $request->urlvideo);
                $video_id = substr($video_id[1],0,11);
            }else{
                $video_id=null;
            }
            $data = new berita();
            $data->judulberita = $request->judul_berita;
            $data->deskripsi = $request->isi_berita;
            $data->urlvideo = $video_id;
            $data->save();

           
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }
        
        
        }else{
        
            return redirect('admin');
        }

    } 


     public function addpengumuman(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            if($request->hasfile('url_gambar')){
            
            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            $data = new pengumumandesa();
            $data->judulpengumuman = $request->judul_pengumuman;
            $data->deskripsi = $request->isi_pengumuman;
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            $data->urlgambar ='/uploadsgambar/'.$fileName;
            $data->save();

            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            return redirect('formaddpengumuman')->with('message', 'Tolong upload gambar');

        }
        
        }else{
        
            return redirect('admin');
        }

    }



    public function addjmlpend(Request $request)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            $data = new jmlpend();
            $data->wilayah = $request->wilayah;
            $data->jumlah = $request->jumlah;
            $data->save();

            $var="data berhasil di simpan";
            return redirect('admin#tabelberita')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


            
    }

    public function addstatpendidikanpend(Request $request)
    {
    	# code...

        if(Auth::user()->roles == "kades"){

            $data = new statpendidikanpend();
            $data->pendidikan = $request->get('Pendidikan');
            $data->pria = $request->pria;
            $data->wanita = $request->wanita;
            $data->jumlah = $request->pria + $request->wanita ;
            $data->save();

            $var="data berhasil di simpan";
            return redirect('admin#tabelstatpendidikanpend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


            
    }

    public function addstatagamapend(Request $request)
    {
    	# code...

        if(Auth::user()->roles == "kades"){

            
            $data = new statagamapend();
            $data->agama = $request->agama;
            $data->pria = $request->pria;
            $data->wanita = $request->wanita;
            $data->jumlah = $request->pria + $request->wanita ;
            $data->save();

            $var="data berhasil di simpan";
            return redirect('admin#tabelstatagamapend')->with('key', $var);        
        }else{
        
            return redirect('admin');
        }


            

    }

    public function addstatpekerjaanpend(Request $request)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
            $data = new statpekerjaanpend();
            $data->pekerjaan = $request->pekerjaan;
            $data->pria = $request->pria;
            $data->wanita = $request->wanita;
            $data->jumlah = $request->pria + $request->wanita ;
            $data->save();

            $var="data berhasil di simpan";
            return redirect('admin#tabelstatpekerjaanpend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


            

    }

    public function addstatetnispend(Request $request)
    {
    	# code...
        if(Auth::user()->roles == "kades"){
            $data = new statetnispend();
            $data->etnis = $request->etnis;
            $data->pria = $request->pria;
            $data->wanita = $request->wanita;
            $data->jumlah = $request->pria + $request->wanita ;
            $data->save();

            $var="data berhasil di simpan";
            return redirect('admin#tabelstatetnispend')->with('key', $var);
        
        
        }else{
        
            return redirect('admin');
        }


            

    }


     public function editberita(Request $request,$id)
    {


        if(Auth::user()->roles == "kades"){
            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
            }

            if($request->hasfile('url_gambar')){

            
            $filesebelumnya = berita::find($id);
            File::delete('storage/'.basename($filesebelumnya->urlgambar));
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            if($request->urlvideo != null){
                $video_id = explode("?v=", $request->urlvideo);
                $video_id = substr($video_id[1],0,11);
            }else{
                $video_id=null;
            }
            berita::find($id)->update([
            'judulberita' => $request->judul_berita,
            'deskripsi' => $request->isi_berita,
            'urlvideo' => $video_id,
            'urlgambar' => '/uploadsgambar/'.$fileName
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');

            }else{
               if($request->urlvideo != null){
                $video_id = explode("?v=", $request->urlvideo);
                $video_id = substr($video_id[1],0,11);
            }else{
                $video_id=null;
            }
                berita::find($id)->update([
            'judulberita' => $request->judul_berita,
            'deskripsi' => $request->isi_berita,
            'urlvideo' => $video_id,

         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');
            }

        }else{
        
            return redirect('admin');
        }
 
    } 


    public function editbarangdesa(Request $request,$id)
    {

         if(Auth::user()->roles == "member"){

            if($request->hasfile('url_gambar')){

            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

                $filesebelumnya = barangdesa::find($id);
                File::delete('storage/'.basename($filesebelumnya->urlgambar));

                $fileName = $request->url_gambar->getClientOriginalName();
                $path = public_path().'/uploadsgambar';
                $upload = $request->url_gambar->move($path,$fileName);
                barangdesa::find($id)->update([
                'nama' => $request->nama_barang,
                'kategori' => $request->get('kategori'),
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'deskripsi' => $request->deskripsi_barang,
                'urlgambar' => '/uploadsgambar/'.$fileName
                ]);
            
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            
                barangdesa::find($id)->update([
                'nama' => $request->nama_barang,
                'kategori' => $request->get('kategori'),
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'deskripsi' => $request->deskripsi_barang,
                
                ]);
            
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }
        
        
        }else{
        
            return redirect('admin');
        }


 
    } 




    public function editbumdes(Request $request,$id)
    {

         if(Auth::user()->roles == "kades"){

            if($request->hasfile('url_gambar')){

            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'image|max:1000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

                $filesebelumnya = bumdes::find($id);
                File::delete('storage/'.basename($filesebelumnya->urlgambar));

                $fileName = $request->url_gambar->getClientOriginalName();
                $path = public_path().'/uploadsgambar';
                $upload = $request->url_gambar->move($path,$fileName);
                bumdes::find($id)->update([
                'nama' => $request->nama_barang,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'deskripsi' => $request->deskripsi_barang,
                'urlgambar' => '/uploadsgambar/'.$fileName
                ]);
            
            return redirect('admin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('formeditbumdes')->with('message', 'Tolong upload gambar');

        }
        
        
        }else{
        
            return redirect('admin');
        }


 
    } 



    public function editpengumuman(Request $request,$id)
    {


        if(Auth::user()->roles == "kades"){
            if($request->hasfile('url_gambar')){

            $validator = Validator::make(request()->all(), [
                'url_gambar' => 'required',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

            $filesebelumnya = pengumumandesa::find($id);
            File::delete('uploadsgambar/'.basename($filesebelumnya->urlgambar));
           
            
            $fileName = $request->url_gambar->getClientOriginalName();
            $path = public_path().'/uploadsgambar';
            $upload = $request->url_gambar->move($path,$fileName);
            pengumumandesa::find($id)->update([
            'judulpengumuman' => $request->judul_pengumuman,
            'deskripsi' => $request->isi_pengumuman,
            'urlgambar' => '/uploadsgambar/'.$fileName
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');

            }else{
               
                pengumumandesa::find($id)->update([
            'judulpengumuman' => $request->judul_pengumuman,
            'deskripsi' => $request->isi_pengumuman,
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');
            }

        }else{
        
            return redirect('admin');
        }


    }



    public function editjmlpend(Request $request,$id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            jmlpend::find($id)->update([
            'wilayah' => $request->wilayah,
            'jumlah' => $request->jumlah
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelberita')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }

    public function editstatpendidikanpend(Request $request,$id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            statpendidikanpend::find($id)->update([
            'pendidikan' => $request->get('Pendidikan'),
            'pria' => $request->pria,
            'wanita' => $request->wanita,
            'jumlah' => $request->pria + $request->wanita 
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelstatpendidikanpend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


        
    }

    public function editstatagamapend(Request $request,$id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            statagamapend::find($id)->update([
            'agama' => $request->agama,
            'pria' => $request->pria,
            'wanita' => $request->wanita,
            'jumlah' => $request->pria + $request->wanita 
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelstatagamapend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }

    public function editstatpekerjaanpend(Request $request,$id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            statpekerjaanpend::find($id)->update([
            'pekerjaan' => $request->pekerjaan,
            'pria' => $request->pria,
            'wanita' => $request->wanita,
            'jumlah' => $request->pria + $request->wanita 
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelstatpekerjaanpend')->with('key', $var);        
        }else{
        
            return redirect('admin');
        }

    }

    public function editstatetnispend(Request $request,$id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            statetnispend::find($id)->update([
            'etnis' => $request->etnis,
            'pria' => $request->pria,
            'wanita' => $request->wanita,
            'jumlah' => $request->pria + $request->wanita 
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelstatetnispend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }




    public function deleteberita($id)
    {
        # code...

        if(Auth::user()->roles == "kades"){
        
        berita::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di simpan');
        }else{
        
            return redirect('admin');
        }


    }


    public function deletepengumuman($id)
    {
        # code...

        if(Auth::user()->roles == "kades"){
            pengumumandesa::where('id',$id)->delete();
            $var="Data berhasil di hapus";
            return redirect('admin')->with('key2', $var);        
        }else{
        
            return redirect('admin');
        }

    }


    public function deletejmlpend($id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
        jmlpend::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin#tabelberita')->with('key', $var);        
        }else{
        
            return redirect('admin');
        }

    }

    public function deletestatpendidikanpend($id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
        statpendidikanpend::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin#tabelstatpendidikanpend')->with('key', $var);        
        }else{
        
            return redirect('admin');
        }


    }

    public function deletestatagamapend($id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
            statagamapend::where('id',$id)->delete();
            $var="Data berhasil di hapus";
            return redirect('admin#tabelstatagamapend')->with('key', $var);        
        }else{
        
            return redirect('admin');
        }

    }

    public function deletestatpekerjaanpend($id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
        statpekerjaanpend::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin#tabelstatpekerjaanpend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }

    public function deletestatetnispend($id)
    {
    	# code...

        if(Auth::user()->roles == "kades"){
        statetnispend::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin#tabelstatetnispend')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }


    public function deletebarangdesa($id)
    {
        # code...

        if(Auth::user()->roles == "member"){
        
        barangdesa::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di simpan');
        }else{
        
            return redirect('admin');
        }


    }



    public function editdeskripsiprofildesa(Request $request)
    {


        if(Auth::user()->roles == "kades"){
            
            profildesa::find(1)->update([
            'desripsiprofildesa' => $request->deskripsiprofildesa,
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');

            

        }else{
        
            return redirect('admin');
        }
 
    }


     public function deleteakun($id)
    {
        # code...

        if(Auth::user()->roles == "kades"){
        
        User::where('id',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di simpan');
        }else{
        
            return redirect('admin');
        }


    }

     public function aktifasiakun($id)
    {


        if(Auth::user()->roles == "kades"){
            User::find($id)->update([
            'status' => "aktif"
         ]);    

            
            return redirect('admin#dataakundesa')->with('message', 'akun telah di aktifkan');

            

        }else{
        
            return redirect('admin');
        }
 
    }

    public function deaktifasiakun($id)
    {


        if(Auth::user()->roles == "kades"){
            User::find($id)->update([
            'status' => "tidak aktif"
         ]);    

            
            return redirect('admin#dataakundesa')->with('message', 'akun telah di aktifkan');

            

        }else{
        
            return redirect('admin');
        }
 
    }  




     public function formadddatapendudukkadus()
    {
        if(Auth::user()->roles == "kadus"){

            $tabel_agamas= tabel_agama::where('id','!=',0)->get();
        $tabel_golongan_darahs= tabel_golongan_darah::where('id','!=',0)->get();
        $tabel_jenis_pekerjaans= tabel_jenis_pekerjaan::where('id','!=',0)->get();
        $tabel_kewarganegaraans= tabel_kewarganegaraan::where('id','!=',0)->get();
        $tabel_pendidikans= tabel_pendidikan::where('id','!=',0)->get();
        $tabel_status_perkawinans= tabel_status_perkawinan::where('id','!=',0)->get();
        $tabel_jenis_kelamins= tabel_jenis_kelamin::where('id','!=',0)->get();
        $tabel_status_hubungan_dalam_keluargas= tabel_status_hubungan_dalam_keluarga::where('id','!=',0)->get();
        $kode_data_akta_lahirs= kode_data_akta_lahir::where('id','!=',0)->get();
        $kode_data_cacats= kode_data_cacat::where('id','!=',0)->get();
        $kode_data_cara_kbs= kode_data_cara_kb::where('id','!=',0)->get();
        
        return view('adminCRUD/adddatapendudukkadus',['tabel_agamas' => $tabel_agamas,'tabel_golongan_darahs' => $tabel_golongan_darahs,'tabel_jenis_pekerjaans' => $tabel_jenis_pekerjaans,'tabel_kewarganegaraans' => $tabel_kewarganegaraans,'tabel_pendidikans' => $tabel_pendidikans,'tabel_status_perkawinans' => $tabel_status_perkawinans,'tabel_jenis_kelamins' => $tabel_jenis_kelamins,'tabel_status_hubungan_dalam_keluargas' => $tabel_status_hubungan_dalam_keluargas,'kode_data_akta_lahirs' => $kode_data_akta_lahirs,'kode_data_cacats' => $kode_data_cacats,'kode_data_cara_kbs' => $kode_data_cara_kbs]);
    }else{
        
        return redirect('admin');
    }

    }



     public function formadddatapendudukkades()
    {
        if(Auth::user()->roles == "kades"){

            $kode_area_dusuns=kode_area_dusun::all();
        $tabel_agamas= tabel_agama::where('id','!=',0)->get();
        $tabel_golongan_darahs= tabel_golongan_darah::where('id','!=',0)->get();
        $tabel_jenis_pekerjaans= tabel_jenis_pekerjaan::where('id','!=',0)->get();
        $tabel_kewarganegaraans= tabel_kewarganegaraan::where('id','!=',0)->get();
        $tabel_pendidikans= tabel_pendidikan::where('id','!=',0)->get();
        $tabel_status_perkawinans= tabel_status_perkawinan::where('id','!=',0)->get();
        $tabel_jenis_kelamins= tabel_jenis_kelamin::where('id','!=',0)->get();
        $tabel_status_hubungan_dalam_keluargas= tabel_status_hubungan_dalam_keluarga::where('id','!=',0)->get();
        $kode_data_akta_lahirs= kode_data_akta_lahir::where('id','!=',0)->get();
        $kode_data_cacats= kode_data_cacat::where('id','!=',0)->get();
        $kode_data_cara_kbs= kode_data_cara_kb::where('id','!=',0)->get();
        
        return view('adminCRUD/adddatapendudukkades',['kode_area_dusuns'=> $kode_area_dusuns,'tabel_agamas' => $tabel_agamas,'tabel_golongan_darahs' => $tabel_golongan_darahs,'tabel_jenis_pekerjaans' => $tabel_jenis_pekerjaans,'tabel_kewarganegaraans' => $tabel_kewarganegaraans,'tabel_pendidikans' => $tabel_pendidikans,'tabel_status_perkawinans' => $tabel_status_perkawinans,'tabel_jenis_kelamins' => $tabel_jenis_kelamins,'tabel_status_hubungan_dalam_keluargas' => $tabel_status_hubungan_dalam_keluargas,'kode_data_akta_lahirs' => $kode_data_akta_lahirs,'kode_data_cacats' => $kode_data_cacats,'kode_data_cara_kbs' => $kode_data_cara_kbs]);
    }else{
        
        return redirect('admin');
    }

    }


 public function formeditdatapendudukkadus($id)
    {
        # code...
        if(Auth::user()->roles == "kadus"){
        $data_penduduks=data_penduduk::where('NIK',$id)->get();
        $tabel_agama_defaults=tabel_agama::where('id',$data_penduduks[0]->Agama)->get();
        $tabel_golongan_darah_defaults=tabel_golongan_darah::where('id',$data_penduduks[0]->Golongan_Darah)->get();
        $tabel_jenis_pekerjaan_defaults=tabel_jenis_pekerjaan::where('id',$data_penduduks[0]->Jenis_Pekerjaan)->get();
        $tabel_kewarganegaraan_defaults=tabel_kewarganegaraan::where('id',$data_penduduks[0]->Kewarganegaraan)->get();
        $tabel_pendidikan_defaults=tabel_pendidikan::where('id',$data_penduduks[0]->Pendidikan)->get();
        $tabel_status_perkawinan_defaults=tabel_status_perkawinan::where('id',$data_penduduks[0]->Status_Perkawinan)->get();
        $tabel_jenis_kelamin_defaults=tabel_jenis_kelamin::where('id',$data_penduduks[0]->Jenis_Kelamin)->get();
        $tabel_status_hubungan_dalam_keluarga_defaults=tabel_status_hubungan_dalam_keluarga::where('id',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga)->get();
        $kode_data_akta_lahir_defaults=kode_data_akta_lahir::where('id',$data_penduduks[0]->Akta_Lahir)->get();
        $kode_data_cacat_defaults=kode_data_cacat::where('id',$data_penduduks[0]->Cacat)->get();
        $kode_data_cara_kb_defaults=kode_data_cara_kb::where('id',$data_penduduks[0]->Cara_KB)->get();



        $tabel_agamas= tabel_agama::where('id','!=',$data_penduduks[0]->Agama)->where('id','!=',0)->get();
        $tabel_golongan_darahs= tabel_golongan_darah::where('id','!=',$data_penduduks[0]->Golongan_Darah)->where('id','!=',0)->get();
        $tabel_jenis_pekerjaans= tabel_jenis_pekerjaan::where('id','!=',$data_penduduks[0]->Jenis_Pekerjaan)->where('id','!=',0)->get();
        $tabel_kewarganegaraans= tabel_kewarganegaraan::where('id','!=',$data_penduduks[0]->Kewarganegaraan)->where('id','!=',0)->get();
        $tabel_pendidikans= tabel_pendidikan::where('id','!=',$data_penduduks[0]->Pendidikan)->where('id','!=',0)->get();
        $tabel_status_perkawinans= tabel_status_perkawinan::where('id','!=',$data_penduduks[0]->Status_Perkawinan)->where('id','!=',0)->get();
        $tabel_jenis_kelamins= tabel_jenis_kelamin::where('id','!=',$data_penduduks[0]->Jenis_Kelamin)->where('id','!=',0)->get();
        $tabel_status_hubungan_dalam_keluargas= tabel_status_hubungan_dalam_keluarga::where('id','!=',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga)->where('id','!=',0)->get();

        $kode_data_akta_lahirs= kode_data_akta_lahir::where('id','!=',$data_penduduks[0]->Akta_Lahir)->where('id','!=',0)->get();
        $kode_data_cacats= kode_data_cacat::where('id','!=',$data_penduduks[0]->Cacat)->where('id','!=',0)->get();
        $kode_data_cara_kbs= kode_data_cara_kb::where('id','!=',$data_penduduks[0]->Cara_KB)->where('id','!=',0)->get();

        return view('adminCRUD/editdatapendudukkadus',['data_penduduks' => $data_penduduks,'tabel_agamas'=> $tabel_agamas,'tabel_agama_defaults'=> $tabel_agama_defaults,'tabel_golongan_darahs'=> $tabel_golongan_darahs,'tabel_golongan_darah_defaults'=> $tabel_golongan_darah_defaults,'tabel_jenis_pekerjaans'=> $tabel_jenis_pekerjaans,'tabel_jenis_pekerjaan_defaults'=> $tabel_jenis_pekerjaan_defaults,'tabel_kewarganegaraans'=> $tabel_kewarganegaraans,'tabel_kewarganegaraan_defaults'=> $tabel_kewarganegaraan_defaults,'tabel_pendidikans'=> $tabel_pendidikans,'tabel_pendidikan_defaults'=> $tabel_pendidikan_defaults,'tabel_status_perkawinans'=> $tabel_status_perkawinans,'tabel_status_perkawinan_defaults'=> $tabel_status_perkawinan_defaults,'tabel_jenis_kelamins'=> $tabel_jenis_kelamins,'tabel_jenis_kelamin_defaults'=> $tabel_jenis_kelamin_defaults,'tabel_status_hubungan_dalam_keluargas'=> $tabel_status_hubungan_dalam_keluargas,'tabel_status_hubungan_dalam_keluarga_defaults'=> $tabel_status_hubungan_dalam_keluarga_defaults,'kode_data_akta_lahirs'=> $kode_data_akta_lahirs,'kode_data_akta_lahir_defaults'=> $kode_data_akta_lahir_defaults,'kode_data_cacats'=> $kode_data_cacats,'kode_data_cacat_defaults'=> $kode_data_cacat_defaults,'kode_data_cara_kbs'=> $kode_data_cara_kbs,'kode_data_cara_kb_defaults'=> $kode_data_cara_kb_defaults]);
        }else{
        
            return redirect('admin');
        }
        
    }




    public function formeditdatapendudukkades($id,$id2)
    {
        # code...
        if(Auth::user()->roles == "kades"){
        $data_penduduks=data_penduduk::where('Id_Dusun',$id2)->where('NIK',$id)->get();
        $kode_area_dusun_defaults=kode_area_dusun::where('Id_Dusun',$id2)->get();
        $tabel_agama_defaults=tabel_agama::where('id',$data_penduduks[0]->Agama)->get();
        $tabel_golongan_darah_defaults=tabel_golongan_darah::where('id',$data_penduduks[0]->Golongan_Darah)->get();
        $tabel_jenis_pekerjaan_defaults=tabel_jenis_pekerjaan::where('id',$data_penduduks[0]->Jenis_Pekerjaan)->get();
        $tabel_kewarganegaraan_defaults=tabel_kewarganegaraan::where('id',$data_penduduks[0]->Kewarganegaraan)->get();
        $tabel_pendidikan_defaults=tabel_pendidikan::where('id',$data_penduduks[0]->Pendidikan)->get();
        $tabel_status_perkawinan_defaults=tabel_status_perkawinan::where('id',$data_penduduks[0]->Status_Perkawinan)->get();
        $tabel_jenis_kelamin_defaults=tabel_jenis_kelamin::where('id',$data_penduduks[0]->Jenis_Kelamin)->get();
        $tabel_status_hubungan_dalam_keluarga_defaults=tabel_status_hubungan_dalam_keluarga::where('id',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga)->get();

        $kode_data_akta_lahir_defaults=kode_data_akta_lahir::where('id',$data_penduduks[0]->Akta_Lahir)->get();
        $kode_data_cacat_defaults=kode_data_cacat::where('id',$data_penduduks[0]->Cacat)->get();
        $kode_data_cara_kb_defaults=kode_data_cara_kb::where('id',$data_penduduks[0]->Cara_KB)->get();


        $kode_area_dusuns=kode_area_dusun::where('Id_Dusun','!=',$id2)->get();

        $tabel_agamas= tabel_agama::where('id','!=',$data_penduduks[0]->Agama)->where('id','!=',0)->get();
        $tabel_golongan_darahs= tabel_golongan_darah::where('id','!=',$data_penduduks[0]->Golongan_Darah)->where('id','!=',0)->get();
        $tabel_jenis_pekerjaans= tabel_jenis_pekerjaan::where('id','!=',$data_penduduks[0]->Jenis_Pekerjaan)->where('id','!=',0)->get();
        $tabel_kewarganegaraans= tabel_kewarganegaraan::where('id','!=',$data_penduduks[0]->Kewarganegaraan)->where('id','!=',0)->get();
        $tabel_pendidikans= tabel_pendidikan::where('id','!=',$data_penduduks[0]->Pendidikan)->where('id','!=',0)->get();
        $tabel_status_perkawinans= tabel_status_perkawinan::where('id','!=',$data_penduduks[0]->Status_Perkawinan)->where('id','!=',0)->get();
        $tabel_jenis_kelamins= tabel_jenis_kelamin::where('id','!=',$data_penduduks[0]->Jenis_Kelamin)->where('id','!=',0)->get();
        $tabel_status_hubungan_dalam_keluargas= tabel_status_hubungan_dalam_keluarga::where('id','!=',$data_penduduks[0]->status_hubungan_dalam_keluarga)->where('id','!=',0)->get();

        $kode_data_akta_lahirs= kode_data_akta_lahir::where('id','!=',$data_penduduks[0]->Akta_Lahir)->where('id','!=',0)->get();
        $kode_data_cacats= kode_data_cacat::where('id','!=',$data_penduduks[0]->Cacat)->where('id','!=',0)->get();
        $kode_data_cara_kbs= kode_data_cara_kb::where('id','!=',$data_penduduks[0]->Cara_KB)->where('id','!=',0)->get();
        return view('adminCRUD/editdatapendudukkades',['data_penduduks' => $data_penduduks,'kode_area_dusuns'=> $kode_area_dusuns,'kode_area_dusun_defaults'=> $kode_area_dusun_defaults,'tabel_agamas'=> $tabel_agamas,'tabel_agama_defaults'=> $tabel_agama_defaults,'tabel_golongan_darahs'=> $tabel_golongan_darahs,'tabel_golongan_darah_defaults'=> $tabel_golongan_darah_defaults,'tabel_jenis_pekerjaans'=> $tabel_jenis_pekerjaans,'tabel_jenis_pekerjaan_defaults'=> $tabel_jenis_pekerjaan_defaults,'tabel_kewarganegaraans'=> $tabel_kewarganegaraans,'tabel_kewarganegaraan_defaults'=> $tabel_kewarganegaraan_defaults,'tabel_pendidikans'=> $tabel_pendidikans,'tabel_pendidikan_defaults'=> $tabel_pendidikan_defaults,'tabel_status_perkawinans'=> $tabel_status_perkawinans,'tabel_status_perkawinan_defaults'=> $tabel_status_perkawinan_defaults,'tabel_jenis_kelamins'=> $tabel_jenis_kelamins,'tabel_jenis_kelamin_defaults'=> $tabel_jenis_kelamin_defaults,'tabel_status_hubungan_dalam_keluargas'=> $tabel_status_hubungan_dalam_keluargas,'tabel_status_hubungan_dalam_keluarga_defaults'=> $tabel_status_hubungan_dalam_keluarga_defaults,'kode_data_akta_lahirs'=> $kode_data_akta_lahirs,'kode_data_akta_lahir_defaults'=> $kode_data_akta_lahir_defaults,'kode_data_cacats'=> $kode_data_cacats,'kode_data_cacat_defaults'=> $kode_data_cacat_defaults,'kode_data_cara_kbs'=> $kode_data_cara_kbs,'kode_data_cara_kb_defaults'=> $kode_data_cara_kb_defaults]);
        }else{
        
            return redirect('admin');
        }
        
    }

    public function formeditdatapendudukwarga($id,$id2)
    {
        # code...
        if(Auth::user()->roles == "member"){
        $data_penduduks=data_penduduk::where('Id_Dusun',$id2)->where('NIK',$id)->get();
        $kode_area_dusun_defaults=kode_area_dusun::where('Id_Dusun',$id2)->get();
        $tabel_agama_defaults=tabel_agama::where('id',$data_penduduks[0]->Agama)->get();
        $tabel_golongan_darah_defaults=tabel_golongan_darah::where('id',$data_penduduks[0]->Golongan_Darah)->get();
        $tabel_jenis_pekerjaan_defaults=tabel_jenis_pekerjaan::where('id',$data_penduduks[0]->Jenis_Pekerjaan)->get();
        $tabel_kewarganegaraan_defaults=tabel_kewarganegaraan::where('id',$data_penduduks[0]->Kewarganegaraan)->get();
        $tabel_pendidikan_defaults=tabel_pendidikan::where('id',$data_penduduks[0]->Pendidikan)->get();
        $tabel_status_perkawinan_defaults=tabel_status_perkawinan::where('id',$data_penduduks[0]->Status_Perkawinan)->get();
        $tabel_jenis_kelamin_defaults=tabel_jenis_kelamin::where('id',$data_penduduks[0]->Jenis_Kelamin)->get();
        $tabel_status_hubungan_dalam_keluarga_defaults=tabel_status_hubungan_dalam_keluarga::where('id',$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga)->get();
        $kode_data_akta_lahir_defaults=kode_data_akta_lahir::where('id',$data_penduduks[0]->Akta_Lahir)->get();
        $kode_data_cacat_defaults=kode_data_cacat::where('id',$data_penduduks[0]->Cacat)->get();
        $kode_data_cara_kb_defaults=kode_data_cara_kb::where('id',$data_penduduks[0]->Cara_KB)->get();
        $kode_area_dusuns=kode_area_dusun::where('Id_Dusun','!=',$id2)->get();
        $tabel_agamas= tabel_agama::where('id','!=',$data_penduduks[0]->Agama)->where('id','!=',0)->get();
        $tabel_golongan_darahs= tabel_golongan_darah::where('id','!=',$data_penduduks[0]->Golongan_Darah)->where('id','!=',0)->get();
        $tabel_jenis_pekerjaans= tabel_jenis_pekerjaan::where('id','!=',$data_penduduks[0]->Jenis_Pekerjaan)->where('id','!=',0)->get();
        $tabel_kewarganegaraans= tabel_kewarganegaraan::where('id','!=',$data_penduduks[0]->Kewarganegaraan)->where('id','!=',0)->get();
        $tabel_pendidikans= tabel_pendidikan::where('id','!=',$data_penduduks[0]->Pendidikan)->where('id','!=',0)->get();
        $tabel_status_perkawinans= tabel_status_perkawinan::where('id','!=',$data_penduduks[0]->Status_Perkawinan)->where('id','!=',0)->get();
        $tabel_jenis_kelamins= tabel_jenis_kelamin::where('id','!=',$data_penduduks[0]->Jenis_Kelamin)->where('id','!=',0)->get();
        $tabel_status_hubungan_dalam_keluargas= tabel_status_hubungan_dalam_keluarga::where('id','!=',$data_penduduks[0]->status_hubungan_dalam_keluarga)->where('id','!=',0)->get();
        $kode_data_akta_lahirs= kode_data_akta_lahir::where('id','!=',$data_penduduks[0]->Akta_Lahir)->where('id','!=',0)->get();
        $kode_data_cacats= kode_data_cacat::where('id','!=',$data_penduduks[0]->Cacat)->where('id','!=',0)->get();
        $kode_data_cara_kbs= kode_data_cara_kb::where('id','!=',$data_penduduks[0]->Cara_KB)->where('id','!=',0)->get();
        return view('adminCRUD/editdatapendudukwarga',['data_penduduks' => $data_penduduks,'kode_area_dusuns'=> $kode_area_dusuns,'kode_area_dusun_defaults'=> $kode_area_dusun_defaults,'tabel_agamas'=> $tabel_agamas,'tabel_agama_defaults'=> $tabel_agama_defaults,'tabel_golongan_darahs'=> $tabel_golongan_darahs,'tabel_golongan_darah_defaults'=> $tabel_golongan_darah_defaults,'tabel_jenis_pekerjaans'=> $tabel_jenis_pekerjaans,'tabel_jenis_pekerjaan_defaults'=> $tabel_jenis_pekerjaan_defaults,'tabel_kewarganegaraans'=> $tabel_kewarganegaraans,'tabel_kewarganegaraan_defaults'=> $tabel_kewarganegaraan_defaults,'tabel_pendidikans'=> $tabel_pendidikans,'tabel_pendidikan_defaults'=> $tabel_pendidikan_defaults,'tabel_status_perkawinans'=> $tabel_status_perkawinans,'tabel_status_perkawinan_defaults'=> $tabel_status_perkawinan_defaults,'tabel_jenis_kelamins'=> $tabel_jenis_kelamins,'tabel_jenis_kelamin_defaults'=> $tabel_jenis_kelamin_defaults,'tabel_status_hubungan_dalam_keluargas'=> $tabel_status_hubungan_dalam_keluargas,'tabel_status_hubungan_dalam_keluarga_defaults'=> $tabel_status_hubungan_dalam_keluarga_defaults,'kode_data_akta_lahirs'=> $kode_data_akta_lahirs,'kode_data_akta_lahir_defaults'=> $kode_data_akta_lahir_defaults,'kode_data_cacats'=> $kode_data_cacats,'kode_data_cacat_defaults'=> $kode_data_cacat_defaults,'kode_data_cara_kbs'=> $kode_data_cara_kbs,'kode_data_cara_kb_defaults'=> $kode_data_cara_kb_defaults]);
        }else{
        
            return redirect('admin');
        }
        
    }


public function adddatapendudukkadus(Request $request)
    {
        # code...

        if(Auth::user()->roles == "kadus"){

            $validator = Validator::make(request()->all(), [
                'NIK','Jenis_Kelamin', 'Agama','Pendidikan','Jenis_Pekerjaan','Status_Perkawinan','Kewarganegaraan','Golongan_Darah' => 'required',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }


            
        
            
            $id_dusuns=kode_area_dusun::where('id_kadus',Auth::user()->id)->get();

            if($request->hasfile('foto_ktp') && $request->hasfile('foto_kk')){


             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $pathkk = public_path().'/uploadsgambar';

            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);

            
            

            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $id_dusuns[0]->id_dusun;
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_ktp =  '/uploadsgambar/'.$fileNamektp;
            $data->foto_kk = '/uploadsgambar/'.$fileNamekk;
            
            $data->save();
        }elseif($request->hasfile('foto_ktp')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);

            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $id_dusuns[0]->id_dusun;
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_ktp =  '/uploadsgambar/'.$fileNamektp;
            
            $data->save();
        }elseif($request->hasfile('foto_kk')){

                         $filesebelumnya = data_penduduk::where('NIK',$id)->get();
                        File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
                        $fileNamekk = $request->foto_kk->getClientOriginalName();
                        $pathkk = public_path().'/uploadsgambar';
                        $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);
                    $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $id_dusuns[0]->id_dusun;
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_kk = '/uploadsgambar/'.$fileNamekk;
            
            $data->save();
        }else{
            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $id_dusuns[0]->id_dusun;
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            
            $data->save();
        }

            $var="data berhasil di simpan";
            return redirect('admin')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


            
    }


    public function adddatapendudukkades(Request $request)
    {
        # code...

        if(Auth::user()->roles == "kades"){
            
            
            $validator = Validator::make(request()->all(), [
                'NIK','Id_Dusun'=> 'required',
                
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }

              if($request->hasfile('foto_ktp') && $request->hasfile('foto_kk')){


             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $pathkk = public_path().'/uploadsgambar';

            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);
            

            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $request->get('Id_Dusun');
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_ktp =  '/uploadsgambar/'.$fileNamektp;
            $data->foto_kk = '/uploadsgambar/'.$fileNamekk;
            
            $data->save();
        }elseif($request->hasfile('foto_ktp')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);

            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $request->get('Id_Dusun');
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_ktp =  '/uploadsgambar/'.$fileNamektp;
            
            $data->save();
        }elseif($request->hasfile('foto_kk')){

                         $filesebelumnya = data_penduduk::where('NIK',$id)->get();
                        File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
                        $fileNamekk = $request->foto_kk->getClientOriginalName();
                        $pathkk = public_path().'/uploadsgambar';
                        $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);
                    $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $request->get('Id_Dusun');
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            $data->foto_kk = '/uploadsgambar/'.$fileNamekk;
            
            $data->save();
        }else{
            $data = new data_penduduk();
            $data->Alamat = $request->Alamat;
            $data->Id_Dusun = $request->get('Id_Dusun');
            $data->RW = $request->RW;
            $data->RT = $request->RT;
            $data->Nama =$request->Nama ;
            $data->Nomor_KK =$request->Nomor_KK ;
            $data->NIK = $request->NIK;
            $data->Jenis_Kelamin = $request->get('jenis_kelamin');
            $data->Tempat_Lahir = $request->Tempat_Lahir;
            $data->Tanggal_Lahir = $request->Tanggal_Lahir;
            $data->Agama = $request->get('Agama');
            $data->Pendidikan = $request->get('Pendidikan');
            $data->Jenis_Pekerjaan = $request->get('Jenis_Pekerjaan');
            $data->Status_Perkawinan = $request->get('Status_Perkawinan');
            $data->Status_Hubungan_Dalam_Keluarga = $request->get('Status_Hubungan_Dalam_Keluarga');
            $data->Kewarganegaraan = $request->get('Kewarganegaraan');
            $data->Nama_Ayah = $request->Nama_Ayah;
            $data->Nama_Ibu = $request->Nama_Ibu;
            $data->Golongan_Darah = $request->get('Golongan_Darah');
            $data->Akta_Lahir = $request->get('Akta_Lahir');
            $data->No_Paspor = $request->No_Paspor;
            $data->Tanggal_akhir_Paspor = $request->Tanggal_akhir_Paspor;
            $data->No_KITAS = $request->No_KITAS;
            $data->NIK_Ayah = $request->NIK_Ayah;
            $data->NIK_Ibu = $request->NIK_Ibu;
            $data->No_Akta_Perkawinan = $request->No_Akta_Perkawinan;
            $data->Tanggal_Perkawinan = $request->Tanggal_Perkawinan;
            $data->No_Akta_Perceraian = $request->No_Akta_Perceraian;
            $data->Tanggal_Perceraian = $request->Tanggal_Perceraian;
            $data->Cacat = $request->get('Cacat');
            $data->Cara_KB = $request->get('Cara_KB');
            $data->Hamil = $request->Hamil;
            $data->tempat_mendapatkan_air_bersih = $request->get('tempat_mendapatkan_air_bersih');
            $data->status_gizi_balita = $request->get('status_gizi_balita');
            $data->kebiasaan_berobat_bila_sakit = $request->get('kebiasaan_berobat_bila_sakit');
            
            $data->save();
        }



            $var="data berhasil di simpan";
            return redirect('admin')->with('key', $var);
        }else{
        
            return redirect('admin');
        }


            
    }


 public function editdatapendudukkadus(Request $request,$id)
    {
        # code...

        
        if(Auth::user()->roles == "kadus"){

            $validator = Validator::make(request()->all(), [
                'NIK' => 'required',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());;
             }


            $Id_Dusun=kode_area_dusun::where('id_kadus',Auth::user()->id)->get();
            if($request->hasfile('foto_ktp') && $request->hasfile('foto_kk')){


             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $pathkk = public_path().'/uploadsgambar';

            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);
            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 

            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            // 'Id_Dusun' => $request->$Id_Dusun[0]->id_dusun,
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_ktp')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 
            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            // 'Id_Dusun' => $request->$Id_Dusun[0]->id_dusun,
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_kk')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathkk = public_path().'/uploadsgambar';
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);
            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 
            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            // 'Id_Dusun' => $request->$Id_Dusun[0]->id_dusun,
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }else{
                $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 
               
                data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            // 'Id_Dusun' => $request->$Id_Dusun[0]->id_dusun,
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);
            }
        }else{
        
            return redirect('admin');
        }

    }


    

    public function editdatapendudukwarga(Request $request,$id,$id2)
    {
        # code...

        
        if(Auth::user()->roles == "member"){
            


            $validator = Validator::make(request()->all(), [
                'NIK' => 'required',
                'Id_Dusun' => 'required',
                'foto_ktp' => 'max:5000',
                'foto_kk' => 'max:5000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
             }


             if($request->hasfile('foto_ktp') && $request->hasfile('foto_kk')){


             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $pathkk = public_path().'/uploadsgambar';

            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1);  

            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_ktp')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1);
            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_kk')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathkk = public_path().'/uploadsgambar';
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1);
            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }else{

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1);
               
                data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);
            }



            
        }else{
        
            return redirect('admin');
        }

    }

    public function editdatapendudukkades(Request $request,$id,$id2)
    {
        # code...

        
        if(Auth::user()->roles == "kades"){
            

            $validator = Validator::make(request()->all(), [
                'NIK' => 'required',
                'Id_Dusun' => 'required',
                'foto_ktp' => 'max:5000',
                'foto_kk' => 'max:5000',
            ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
             }


             if($request->hasfile('foto_ktp') && $request->hasfile('foto_kk')){


             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $pathkk = public_path().'/uploadsgambar';

            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 


            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_ktp')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_ktp));
            $fileNamektp = $request->foto_ktp->getClientOriginalName();
            $pathktp = public_path().'/uploadsgambar';
            $uploadktp = $request->foto_ktp->move($pathktp,$fileNamektp);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 

            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_ktp' => '/uploadsgambar/'.$fileNamektp,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }elseif($request->hasfile('foto_kk')){

             $filesebelumnya = data_penduduk::where('NIK',$id)->get();
            File::delete('storage/'.basename($filesebelumnya[0]->foto_kk));
            $fileNamekk = $request->foto_kk->getClientOriginalName();
            $pathkk = public_path().'/uploadsgambar';
            $uploadkk = $request->foto_kk->move($pathkk,$fileNamekk);

            $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 

            

           data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'foto_kk' => '/uploadsgambar/'.$fileNamekk,
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);

            }else{

                $data_penduduk=data_penduduk::where('NIK',$id)->get();
            
            $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk[0]->Tanggal_Lahir, false);
            $usia = (($rumususia/365)*-1); 

            

               
                data_penduduk::where('NIK',$id)->update([
            'Alamat' => $request->Alamat,
            'Id_Dusun' => $request->get('Id_Dusun'),
            'RW' => $request->RW,
            'RT' => $request->RT,
            'Nama' => $request->Nama,
            'Nomor_KK' => $request->Nomor_KK,
            'NIK' => $request->NIK,
            'Jenis_Kelamin' => $request->get('jenis_kelamin'),
            'Tempat_Lahir' => $request->Tempat_Lahir,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Agama' => $request->get('Agama'),
            'Pendidikan' => $request->get('Pendidikan'),
            'Jenis_Pekerjaan' => $request->get('Jenis_Pekerjaan'),
            'Status_Perkawinan' => $request->get('Status_Perkawinan'),
            'Status_Hubungan_Dalam_Keluarga' => $request->get('Status_Hubungan_Dalam_Keluarga'),
            'Kewarganegaraan' => $request->get('Kewarganegaraan'),
            'Nama_Ayah' => $request->Nama_Ayah,
            'Nama_Ibu' => $request->Nama_Ibu,
            'Golongan_Darah' => $request->get('Golongan_Darah'),
            'Akta_Lahir' => $request->get('Akta_Lahir'),
            'No_Paspor' => $request->No_Paspor,
            'Tanggal_akhir_Paspor' => $request->Tanggal_akhir_Paspor,
            'No_KITAS' => $request->No_KITAS,
            'NIK_Ayah' => $request->NIK_Ayah,
            'NIK_Ibu' => $request->NIK_Ibu,
            'No_Akta_Perkawinan' => $request->No_Akta_Perkawinan,
            'Tanggal_Perkawinan' => $request->Tanggal_Perkawinan,
            'No_Akta_Perceraian' => $request->No_Akta_Perceraian,
            'Tanggal_Perceraian' => $request->Tanggal_Perceraian,
            'Cacat' => $request->get('Cacat'),
            'Cara_KB' => $request->get('Cara_KB'),
            'Hamil' => $request->Hamil,
            'tempat_mendapatkan_air_bersih' => $request->get('tempat_mendapatkan_air_bersih'),
            'status_gizi_balita' => $request->get('status_gizi_balita'),
            'kebiasaan_berobat_bila_sakit' => $request->get('kebiasaan_berobat_bila_sakit'),
            'Usia' => floor($usia)
            
         ]);   

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);
            }



            
        }else{
        
            return redirect('admin');
        }

    }


 public function deletedatapendudukkades($id,$id2)
    {
        # code...

        if(Auth::user()->roles == "kades"){
        
        data_penduduk::where('Id_Dusun',$id2)->where('NIK',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di hapus');
        }else{
        
            return redirect('admin');
        }


    }

 public function deletedatapendudukkadus($id)
    {
        # code...

        if(Auth::user()->roles == "kadus"){
        
        data_penduduk::where('NIK',$id)->delete();
        $var="Data berhasil di hapus";
        return redirect('admin')->with('message', 'data berhasil di hapus');
        }else{
        
            return redirect('admin');
        }


    }


    public function reloadtabeldusun()
    
    {
    if(Request::ajax()){

        // $data_penduduk_kadus_ajax=data_penduduk_kadus::where('id_kadus',$id)->get();

        // return $data_penduduk_kadus_ajax;

        return 'succes';
    }
    }


    public function penduduk_keluar($id)
    {
        # code...
        if(Auth::user()->roles == "kadus"){
        
        $kode_area_dusuns=kode_area_dusun::where('id_kadus',Auth::user()->id)->get();
        $data_penduduks=data_penduduk::where('NIK', $id)->get();
        return view('adminCRUD/pendudukkeluar',['data_penduduks' => $data_penduduks,'kode_area_dusuns' => $kode_area_dusuns]);
        }else{
        
            return redirect('admin');
        }

    }


    public function postpenduduk_keluar(Request $request,$id)
    {
        # code...
        if(Auth::user()->roles == "kadus"){
        
        data_penduduk::where('NIK',$id)->update([
            'Status_kependudukan' => $request->get('status_kependudukan'),
            'Keterangan' => $request->keterangan
         ]);

            $var="Data berhasil di ubah";
            return redirect('admin')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }


    public function updateumur()
    {
       //  # code...
       //      $kode_area_dusuns=kode_area_dusun::all();
        

       // for($i=1;$i<=$kode_area_dusuns->count();$i++){
            
       //      $data_penduduks=data_penduduk::where('id_dusun',$i)->get();

       //      foreach ($data_penduduks as $data_penduduk) {
       //          # code...
       //          $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk->Tanggal_Lahir, false);
       //          $usia = (($rumususia/365)*-1);

       //           data_penduduk::where('id_dusun',$i)->update([
       //          'Usia' => floor($usia)            
       //       ]);  
       //      }
       //  }


            $data_penduduks=data_penduduk::all();

            foreach ($data_penduduks as $data_penduduk) {
                # code...
                $rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk->Tanggal_Lahir, false);
                $usia = (($rumususia/365)*-1);

                 data_penduduk::where('NIK',$data_penduduk->NIK)->update([
                'Usia' => floor($usia)            
             ]);  
            }
        


         return "succes";

    }


    public function settingkopsurat(Request $request)
    {
        # code...
         if(Auth::user()->roles == "kades"){
            kopsurat::find(1)->update([
            'Nama_Kabupaten' => $request->Nama_Kabupaten,
            'Nama_Kecamatan' => $request->Nama_Kecamatan,
            'Nama_Desa' => $request->Nama_Desa,
            'Alamat_Desa' => $request->Alamat_Desa
         ]);    

            $var="Data berhasil di ubah";
            return redirect('admin#tabelberita')->with('key', $var);
        }else{
        
            return redirect('admin');
        }

    }


      public function formsettingkopsurat()
    {
        # code...
        
        if(Auth::user()->roles == "kades"){
        
        return view("adminCRUD/settingkopsurat");
        }else{
            
            return redirect('admin');
        }

    }

     public function formeditnmrhp($id)
    {
        # code...
        if(Auth::user()->roles == "member"){
        
        $users=User::where('Nomor_KK',$id)->get();
        return view('adminCRUD/editnmrhp',['users' => $users]);
        }else{
        
            return redirect('admin');
        }
        
    }



 public function editnmrhp(Request $request,$id)
    {


        if(Auth::user()->roles == "member"){

            User::find($id)->update([
            'No_HP' => $request->nmrhp
         ]);    

            
            return redirect('admin')->with('message', 'data berhasil di simpan');


        }else{
        
            return redirect('admin');
        }
 
    }   
    
}



 
