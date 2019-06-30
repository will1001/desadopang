<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\profildesa;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
class gantifotocontroller extends Controller
{
 
   public function editfotokades(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokades' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());
        }
           
            if($request->hasfile('fotokades')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokades));
            $request->fotokades->storeAs('public',$request->fotokades->getClientOriginalName());
            profildesa::find(1)->update([
            'fotokades' => Storage::url($request->fotokades->getClientOriginalName())
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    }

    public function editfotoketbpd(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotoketbpd' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotoketbpd')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotoketbpd));
            $request->fotoketbpd->storeAs('public',$request->fotoketbpd->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotoketbpd' => Storage::url($request->fotoketbpd->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    } 

    public function editfotosekdes(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotosekdes' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotosekdes')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotosekdes));
            $request->fotosekdes->storeAs('public',$request->fotosekdes->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotosekdes' => Storage::url($request->fotosekdes->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    } 


    public function editfotokaurpemerintahan(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokaurpemerintahan' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotokaurpemerintahan')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurpemerintahan));
            $request->fotokaurpemerintahan->storeAs('public',$request->fotokaurpemerintahan->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurpemerintahan' => Storage::url($request->fotokaurpemerintahan->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    }

    public function editfotokaurpembangunan(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokaurpembangunan' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotokaurpembangunan')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurpembangunan));
            $request->fotokaurpembangunan->storeAs('public',$request->fotokaurpembangunan->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurpembangunan' => Storage::url($request->fotokaurpembangunan->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    } 

    public function editfotokaurkeuangan(Request $request)
    {


        if(Auth::user()->roles == "kades"){
           
           $validator = Validator::make(request()->all(), [
                'fotokaurkeuangan' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }

            if($request->hasfile('fotokaurkeuangan')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurkeuangan));
            $request->fotokaurkeuangan->storeAs('public',$request->fotokaurkeuangan->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurkeuangan' => Storage::url($request->fotokaurkeuangan->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    }


    public function editfotokaurumum(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokaurumum' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotokaurumum')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurumum));
            $request->fotokaurumum->storeAs('public',$request->fotokaurumum->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurumum' => Storage::url($request->fotokaurumum->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    }

    public function editfotokaurkesra(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokaurkesra' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotokaurkesra')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurkesra));
            $request->fotokaurkesra->storeAs('public',$request->fotokaurkesra->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurkesra' => Storage::url($request->fotokaurkesra->getClientOriginalName())
            
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    } 

    public function editfotokaurtrantib(Request $request)
    {


        if(Auth::user()->roles == "kades"){

            $validator = Validator::make(request()->all(), [
                'fotokaurtrantib' => 'max:1000',
            ]);
            if ($validator->fails()) {
            return redirect('admin#profildesaadmin')->withErrors($validator->errors());;
             }
           
            if($request->hasfile('fotokaurtrantib')){

            
                       
            $filesebelumnya = profildesa::find(1);
            File::delete('storage/'.basename($filesebelumnya->fotokaurtrantib));
            $request->fotokaurtrantib->storeAs('public',$request->fotokaurtrantib->getClientOriginalName());
            profildesa::find(1)->update([
            
            'fotokaurtrantib' => Storage::url($request->fotokaurtrantib->getClientOriginalName())
         ]);    

           
            return redirect('admin#profildesaadmin')->with('message', 'data berhasil di simpan');

        }else{
            
            return redirect('admin#profildesaadmin')->with('message', 'Tolong upload gambar');

        }

        }else{
        
            return redirect('admin#profildesaadmin');
        }
 
    }




 
}
