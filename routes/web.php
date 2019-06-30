<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'webcontroller@indexhome');
Route::get('/kktidakada', 'webcontroller@kktidakada');
Route::get('/updateumur', 'admincontroller@updateumur');

Route::get('/reloadtabeldatapendudukajax/{id}/{skipdata}',function($id,$skipdata)
{
	if(Request::ajax()){
		// $data_penduduk_kadus_ajax=App\data_penduduk::where('id_dusun',$id)->take(25)->skip($skipdata)->get();
		$data_penduduk_kadus_ajax = DB::table('data_penduduks')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->join('kode_data_akta_lahirs', 'data_penduduks.Akta_Lahir', '=', 'kode_data_akta_lahirs.id')
	            ->join('kode_data_cacats', 'data_penduduks.Cacat', '=', 'kode_data_cacats.id')
	            ->join('kode_data_cara_kbs', 'data_penduduks.Cara_KB', '=', 'kode_data_cara_kbs.id')
	            ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','kode_data_akta_lahirs.akta_lahir','kode_data_cacats.cacat','kode_data_cara_kbs.cara_kb')
	            ->where('id_dusun',$id)->take(25)->skip($skipdata)->get();

        return $data_penduduk_kadus_ajax;
	}
});



Route::get('/cari/{kategori}/{id}',function($kategori,$id)
{
	if(Request::ajax()){
	 $data_penduduk_kadus_ajax=DB::table('data_penduduks')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->join('kode_data_akta_lahirs', 'data_penduduks.Akta_Lahir', '=', 'kode_data_akta_lahirs.id')
	            ->join('kode_data_cacats', 'data_penduduks.Cacat', '=', 'kode_data_cacats.id')
	            ->join('kode_data_cara_kbs', 'data_penduduks.Cara_KB', '=', 'kode_data_cara_kbs.id')
	            ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','kode_data_akta_lahirs.akta_lahir','kode_data_cacats.cacat','kode_data_cara_kbs.cara_kb')
	            ->where($kategori,'LIKE','%'.$id.'%')->get();

        return $data_penduduk_kadus_ajax;
	}
});

Route::get('/caridatakadus/{kategori}/{id}',function($kategori,$id)
{
	
	if(Request::ajax()){
		// $kode_area_dusuns=App\kode_area_dusun::where('id_kadus',Auth::user()->id)->get();
	 $data_penduduk_kadus_ajax=DB::table('data_penduduks')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->join('kode_data_akta_lahirs', 'data_penduduks.Akta_Lahir', '=', 'kode_data_akta_lahirs.id')
	            ->join('kode_data_cacats', 'data_penduduks.Cacat', '=', 'kode_data_cacats.id')
	            ->join('kode_data_cara_kbs', 'data_penduduks.Cara_KB', '=', 'kode_data_cara_kbs.id')
	            ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','kode_data_akta_lahirs.akta_lahir','kode_data_cacats.cacat','kode_data_cara_kbs.cara_kb')
	            ->where($kategori,'LIKE','%'.$id.'%')->get();

        return $data_penduduk_kadus_ajax;
	}

});

Route::get('/reloadtabeldusunurutnama/{id}/{pil}',function($id,$pil)
{
	if(Request::ajax()){

		if($pil==1){
			$data_penduduk_kadus_urut_nama=App\data_penduduk::where('id_dusun',$id)->orderBy("Nama","asc")->get();

        	return $data_penduduk_kadus_urut_nama;
		}else{
			$data_penduduk_kadus_urut_nama=App\data_penduduk::where('id_dusun',$id)->orderBy("Nama","desc")->get();

        	return $data_penduduk_kadus_urut_nama;
		}
		
	}
});


Route::get('/profildesa', 'webcontroller@profildesa');
Route::get('/export_data_penduduk', 'webcontroller@export_data_penduduk');
Route::get('/bumdes', 'webcontroller@bumdes');
Route::get('/statistik', 'webcontroller@statistik');
Route::get('/artisancall', 'webcontroller@artisancall');
Route::get('/SOTK', 'webcontroller@SOTK');
Route::get('/organisasi', 'webcontroller@organisasi');
Route::get('/transparansi/{id}', 'webcontroller@transparansi');
Route::get('/karangtaruna', 'webcontroller@karangtaruna');
Route::get('/BPD', 'webcontroller@BPD');
Route::get('/LPMD', 'webcontroller@LPMD');
Route::get('/beritadesa/', 'webcontroller@beritadesa');
Route::get('/pengumumandesa/', 'webcontroller@pengumumandesa');
Route::get('/detailberitadesa/{id}', 'webcontroller@detailberitadesa');
Route::get('/detailpengumuman/{id}', 'webcontroller@detailpengumuman');
Route::get('/detailberita/{id}', 'webcontroller@detailberita');
Route::get('/barangdesa', 'webcontroller@barangdesa');
Route::post('/caribarangdesa', 'webcontroller@caribarangdesa');
Route::get('/detailbarangdesa/{id}', 'webcontroller@detailbarangdesa');
Route::get('/cekumur/{id}', function($id)
{
	if(Request::ajax()){

         

        $data_penduduks=App\data_penduduk::where('id_dusun',$id)->get();

        foreach ($data_penduduks as $data_penduduk) {
        	# code...
        	$rumususia = Carbon\Carbon::now()->diffInDays($data_penduduk->Tanggal_Lahir, false);
        	$usia = (($rumususia/365)*-1);

        	 data_penduduk::where('NIK',$data_penduduk->NIK)->update([
            'Usia' => $usia            
         ]);  
        }
        

		$data_penduduk_kadus_ajax=App\data_penduduk::where('id_dusun',$id)->where('Usia','>',17)->get();
		

        return $data_penduduk_kadus_ajax;
        
    }
});
Route::post('/editnmrhp/{id}', 'admincontroller@editnmrhp')->middleware('auth');
Route::get('/formeditnmrhp/{id}', 'admincontroller@formeditnmrhp')->middleware('auth');

// form rute
Route::get('/formaddberita', 'admincontroller@formaddberita')->middleware('auth');
Route::get('/formaddpengumuman', 'admincontroller@formaddpengumuman')->middleware('auth');
Route::get('/formaddjmlpend', 'admincontroller@formaddjmlpend')->middleware('auth');
Route::get('/formaddstatpendidikanpend', 'admincontroller@formaddstatpendidikanpend')->middleware('auth');
Route::get('/formaddstatpekerjaanpend', 'admincontroller@formaddstatpekerjaanpend')->middleware('auth');
Route::get('/formaddstatetnispend', 'admincontroller@formaddstatetnispend')->middleware('auth');
Route::get('/formaddstatagamapend', 'admincontroller@formaddstatagamapend')->middleware('auth');
Route::get('/formadddatapendudukkadus', 'admincontroller@formadddatapendudukkadus')->middleware('auth');
Route::get('/formadddatapendudukkades', 'admincontroller@formadddatapendudukkades')->middleware('auth');
Route::get('/formaddbarangdesa/{id}', 'admincontroller@formaddbarangdesa')->middleware('auth');
Route::get('/formaddbumdes/{id}', 'admincontroller@formaddbumdes')->middleware('auth');
Route::get('/formsettingkopsurat', 'admincontroller@formsettingkopsurat')->middleware('auth');
Route::post('/settingkopsurat', 'admincontroller@settingkopsurat')->middleware('auth');
Route::get('/formaddSOTK', 'admincontroller@formaddSOTK')->middleware('auth');





Route::get('/formeditberita/{id}', 'admincontroller@formeditberita')->middleware('auth');
Route::get('/formeditpengumuman/{id}', 'admincontroller@formeditpengumuman')->middleware('auth');
Route::get('/formeditjmlpend/{id}', 'admincontroller@formeditjmlpend')->middleware('auth');
Route::get('/formeditstatpendidikanpend/{id}', 'admincontroller@formeditstatpendidikanpend')->middleware('auth');
Route::get('/formeditstatpekerjaanpend/{id}', 'admincontroller@formeditstatpekerjaanpend')->middleware('auth');
Route::get('/formeditstatetnispend/{id}', 'admincontroller@formeditstatetnispend')->middleware('auth');
Route::get('/formeditstatagamapend/{id}', 'admincontroller@formeditstatagamapend')->middleware('auth');
Route::get('/formuploadapbd/{id}', 'admincontroller@formuploadapbd')->middleware('auth');
Route::get('/formuploadprofildesa', 'admincontroller@formuploadprofildesa')->middleware('auth');
Route::get('/formuploadstatistikdesa', 'admincontroller@formuploadstatistikdesa')->middleware('auth');
Route::get('/formeditbarangdesa/{id}', 'admincontroller@formeditbarangdesa')->middleware('auth');
Route::get('/formeditbumdes/{id}', 'admincontroller@formeditbumdes')->middleware('auth');
Route::get('/formeditdatapendudukkadus/{id}', 'admincontroller@formeditdatapendudukkadus')->middleware('auth');
Route::get('/formeditdatapendudukkades/{id}/{id2}', 'admincontroller@formeditdatapendudukkades')->middleware('auth');
Route::get('/formeditdatapendudukwarga/{id}/{id2}', 'admincontroller@formeditdatapendudukwarga')->middleware('auth');
Route::get('/formeditSOTK/{id}', 'admincontroller@formeditSOTK')->middleware('auth');
Route::get('/deleteSOTK/{id}', 'admincontroller@deleteSOTK');




// delete rute
Route::get('/deleteberita/{id}', 'admincontroller@deleteberita');
Route::get('/deletepengumuman/{id}', 'admincontroller@deletepengumuman');
Route::get('/deletejmlpend/{id}', 'admincontroller@deletejmlpend');
Route::get('/deletestatpendidikanpend/{id}', 'admincontroller@deletestatpendidikanpend');
Route::get('/deletestatagamapend/{id}', 'admincontroller@deletestatagamapend');
Route::get('/deletestatpekerjaanpend/{id}', 'admincontroller@deletestatpekerjaanpend');
Route::get('/deletestatetnispend/{id}', 'admincontroller@deletestatetnispend');
Route::get('/deletedatapendudukkadus/{id}', 'admincontroller@deletedatapendudukkadus');
Route::get('/deletedatapendudukkades/{id}/{id2}', 'admincontroller@deletedatapendudukkades');
Route::get('/deletebarangdesa/{id}', 'admincontroller@deletebarangdesa');





//post add rute
Route::post('/addberita', 'admincontroller@addberita');
Route::post('/addpengumuman', 'admincontroller@addpengumuman');
Route::post('/addjmlpend', 'admincontroller@addjmlpend');
Route::post('/addstatpendidikanpend', 'admincontroller@addstatpendidikanpend');
Route::post('/addstatagamapend', 'admincontroller@addstatagamapend');
Route::post('/addstatpekerjaanpend', 'admincontroller@addstatpekerjaanpend');
Route::post('/addstatetnispend', 'admincontroller@addstatetnispend');
Route::post('/addbarangdesa', 'admincontroller@addbarangdesa');
Route::post('/addbumdes', 'admincontroller@addbumdes');
Route::post('/adddatapendudukkadus', 'admincontroller@adddatapendudukkadus');
Route::post('/adddatapendudukkades', 'admincontroller@adddatapendudukkades');



//post edit rute
Route::post('/editberita/{id}', 'admincontroller@editberita');
Route::post('/editpengumuman/{id}', 'admincontroller@editpengumuman');
Route::post('/editjmlpend/{id}', 'admincontroller@editjmlpend');
Route::post('/editstatpendidikanpend/{id}', 'admincontroller@editstatpendidikanpend');
Route::post('/editstatagamapend/{id}', 'admincontroller@editstatagamapend');
Route::post('/editstatpekerjaanpend/{id}', 'admincontroller@editstatpekerjaanpend');
Route::post('/editstatetnispend/{id}', 'admincontroller@editstatetnispend');
Route::post('/editbarangdesa/{id}', 'admincontroller@editbarangdesa');
Route::post('/editbumdes/{id}', 'admincontroller@editbumdes');
Route::post('/editdatapendudukkadus/{id}', 'admincontroller@editdatapendudukkadus');
Route::post('/editdatapendudukkades/{id}/{id2}', 'admincontroller@editdatapendudukkades');
Route::post('/editdatapendudukwarga/{id}/{id2}', 'admincontroller@editdatapendudukwarga');
Route::post('/editdeskripsiSOTK', 'admincontroller@editdeskripsiSOTK');
Route::get('/penduduk_keluar/{id}', 'admincontroller@penduduk_keluar');
Route::post('/postpenduduk_keluar/{id}', 'admincontroller@postpenduduk_keluar');


//post aktifasi akun
Route::get('/aktifasiakun/{id}', 'admincontroller@aktifasiakun');
Route::get('/deleteakun/{id}', 'admincontroller@deleteakun');






// editfoto
Route::post('/editfotokades', 'gantifotocontroller@editfotokades');
Route::post('/editfotoketbpd', 'gantifotocontroller@editfotoketbpd');
Route::post('/editfotosekdes', 'gantifotocontroller@editfotosekdes');
Route::post('/editfotokaurpemerintahan', 'gantifotocontroller@editfotokaurpemerintahan');
Route::post('/editfotokaurpembangunan', 'gantifotocontroller@editfotokaurpembangunan');
Route::post('/editfotokaurkeuangan', 'gantifotocontroller@editfotokaurkeuangan');
Route::post('/editfotokaurumum', 'gantifotocontroller@editfotokaurumum');
Route::post('/editfotokaurkesra', 'gantifotocontroller@editfotokaurkesra');
Route::post('/editfotokaurtrantib', 'gantifotocontroller@editfotokaurtrantib');
Route::post('/editSOTK/{id}', 'admincontroller@editSOTK');
Route::get('/formeditSOTK/{id}', 'admincontroller@formeditSOTK');




Route::post('/uploadapbd/{id}', 'admincontroller@uploadapbd');
Route::post('/uploadprofildesa', 'admincontroller@uploadprofildesa');
Route::post('/uploadstatistikdesa', 'admincontroller@uploadstatistikdesa');


//Route Surat
Route::get('/formsurat/{id}', 'suratcontroller@formsurat')->middleware('auth');
Route::get('/surat_ket_nikah/{NIK}', 'suratcontroller@surat_ket_nikah');
Route::get('/surat_ket_domisili/{NIK}', 'suratcontroller@surat_ket_domisili');
Route::get('/surat_ket_pindah_penduduk/{NIK}', 'suratcontroller@surat_ket_pindah_penduduk');
Route::get('/surat_izin_keramaian/{NIK}', 'suratcontroller@surat_izin_keramaian');
Route::get('/surat_kehendak_nikah/{NIK}', 'suratcontroller@surat_kehendak_nikah');
Route::get('/surat_ket_wali/{NIK}', 'suratcontroller@surat_ket_wali');
Route::get('/surat_ket_wali_hakim/{NIK}', 'suratcontroller@surat_ket_wali_hakim');
Route::get('/surat_persetujuan_mempelai/{NIK}', 'suratcontroller@surat_persetujuan_mempelai');
Route::get('/surat_bio_penduduk/{NIK}', 'suratcontroller@surat_bio_penduduk');
Route::get('/surat_domisili_usaha_non_warga/{NIK}', 'suratcontroller@surat_domisili_usaha_non_warga');
Route::get('/surat_izin_pengangkutan_kayu/{NIK}', 'suratcontroller@surat_izin_pengangkutan_kayu');
Route::get('/surat_izin_pengangkutan_tanah_urug/{NIK}', 'suratcontroller@surat_izin_pengangkutan_tanah_urug');
Route::get('/surat_ket_beda_identitas_kis/{NIK}', 'suratcontroller@surat_ket_beda_identitas_kis');
Route::get('/surat_ket_beda_nama/{NIK}', 'suratcontroller@surat_ket_beda_nama');
Route::get('/surat_ket_catatan_kriminal/{NIK}', 'suratcontroller@surat_ket_catatan_kriminal');
Route::get('/surat_ket_cerai/{NIK}', 'suratcontroller@surat_ket_cerai');
Route::get('/surat_ket_domisili_usaha/{NIK}', 'suratcontroller@surat_ket_domisili_usaha');
Route::get('/surat_ket_harga_tanah/{NIK}', 'suratcontroller@surat_ket_harga_tanah');
Route::get('/surat_ket_jamkesos/{NIK}', 'suratcontroller@surat_ket_jamkesos');
Route::get('/surat_ket_kehilangan/{NIK}', 'suratcontroller@surat_ket_kehilangan');
Route::get('/surat_ket_jual_beli/{NIK}', 'suratcontroller@surat_ket_jual_beli');
Route::get('/surat_ket_kelakuan_baik/{NIK}', 'suratcontroller@surat_ket_kelakuan_baik');
Route::get('/surat_ket_kepemilikan_kendaraan/{NIK}', 'suratcontroller@surat_ket_kepemilikan_kendaraan');
Route::get('/surat_ket_kepemilikan_tanah/{NIK}', 'suratcontroller@surat_ket_kepemilikan_tanah');
Route::get('/surat_ket_kurang_mampu/{NIK}', 'suratcontroller@surat_ket_kurang_mampu');
Route::get('/surat_ket_luar_daerah/{NIK}', 'suratcontroller@surat_ket_luar_daerah');
Route::get('/surat_ket_luar_negeri/{NIK}', 'suratcontroller@surat_ket_luar_negeri');
Route::get('/surat_ket_penduduk/{NIK}', 'suratcontroller@surat_ket_penduduk');
Route::get('/surat_ket_tidak_memiliki_jamkesos/{NIK}', 'suratcontroller@surat_ket_tidak_memiliki_jamkesos');
Route::get('/surat_ket_usaha/{NIK}', 'suratcontroller@surat_ket_usaha');
Route::get('/surat_ket_yatim/{NIK}', 'suratcontroller@surat_ket_yatim');


//Route Surat kades














//Route file

Route::get('apbd', 'webcontroller@apbd');


Auth::routes();

// Route::get('/admin', 'HomeController@index')->name('admin');


Route::get('/admin', function(){
	if(Auth::user()->roles == "kades" && Auth::user()->status == "aktif"){
		$beritas= App\berita::all();
        $pengumumandesas= App\pengumumandesa::all();
        $SOTKs= App\SOTK::all();
        $bumdess= App\bumdes::all();
        $jmlbarang=$bumdess->count();
        $users= App\User::orderBy('status', 'desc')->get();
        $kode_area_dusuns= App\kode_area_dusun::all();
		return view('adminkades',['beritas' => $beritas, 'pengumumandesas' => $pengumumandesas,'SOTKs' => $SOTKs,'users' => $users,'kode_area_dusuns' => $kode_area_dusuns,'bumdess' => $bumdess,'jmlbarang' => $jmlbarang]);
	}elseif(Auth::user()->roles == "kadus" && Auth::user()->status == "aktif"){
		$users= \App\User::find(Auth::user()->id);
        
        $kode_area_dusuns=App\kode_area_dusun::where('id_kadus',Auth::user()->id)->get();
        // $data_penduduks=App\data_penduduk::where('id_dusun',$kode_area_dusuns[0]->id_dusun)->get();
        $data_penduduks = DB::table('data_penduduks')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->join('kode_data_akta_lahirs', 'data_penduduks.Akta_Lahir', '=', 'kode_data_akta_lahirs.id')
	            ->join('kode_data_cacats', 'data_penduduks.Cacat', '=', 'kode_data_cacats.id')
	            ->join('kode_data_cara_kbs', 'data_penduduks.Cara_KB', '=', 'kode_data_cara_kbs.id')
	            ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','kode_data_akta_lahirs.akta_lahir','kode_data_cacats.cacat','kode_data_cara_kbs.cara_kb')
	            ->where('id_dusun',$kode_area_dusuns[0]->id_dusun)->get();

		return view('adminkadus',['users'=> $users ,'data_penduduks' => $data_penduduks,'kode_area_dusuns' => $kode_area_dusuns]);
	}elseif(Auth::user()->roles == "member" && Auth::user()->status == "aktif"){
		$users= \App\User::find(Auth::user()->id);
		$barangdesas= \App\barangdesa::where('id_pemilik',Auth::user()->id)->get();
		$jmlbarang=$barangdesas->count();
		// $data_penduduks=App\data_penduduk::where('Nomor_KK',Auth::user()->Nomor_KK)->get();
		$data_penduduks = DB::table('data_penduduks')
	            ->join('tabel_agamas', 'data_penduduks.Agama', '=', 'tabel_agamas.id')
	            ->join('tabel_jenis_pekerjaans', 'data_penduduks.Jenis_Pekerjaan', '=', 'tabel_jenis_pekerjaans.id')
	            ->join('tabel_golongan_darahs', 'data_penduduks.Golongan_Darah', '=', 'tabel_golongan_darahs.id')
	            ->join('tabel_kewarganegaraans', 'data_penduduks.Kewarganegaraan', '=', 'tabel_kewarganegaraans.id')
	            ->join('tabel_status_perkawinans', 'data_penduduks.Status_Perkawinan', '=', 'tabel_status_perkawinans.id')
	            ->join('tabel_pendidikans', 'data_penduduks.Pendidikan', '=', 'tabel_pendidikans.id')
	            ->join('tabel_jenis_kelamins', 'data_penduduks.Jenis_Kelamin', '=', 'tabel_jenis_kelamins.id')
	            ->join('tabel_status_hubungan_dalam_keluargas', 'data_penduduks.Status_Hubungan_Dalam_Keluarga', '=', 'tabel_status_hubungan_dalam_keluargas.id')
	            ->join('kode_data_akta_lahirs', 'data_penduduks.Akta_Lahir', '=', 'kode_data_akta_lahirs.id')
	            ->join('kode_data_cacats', 'data_penduduks.Cacat', '=', 'kode_data_cacats.id')
	            ->join('kode_data_cara_kbs', 'data_penduduks.Cara_KB', '=', 'kode_data_cara_kbs.id')
	            ->select('data_penduduks.*', 'tabel_agamas.agama','tabel_jenis_pekerjaans.jenis_pekerjaan','tabel_golongan_darahs.golongan_darah','tabel_kewarganegaraans.kewarganegaraan','tabel_status_perkawinans.status_perkawinan','tabel_pendidikans.pendidikan','tabel_jenis_kelamins.jenis_kelamin','tabel_status_hubungan_dalam_keluargas.status_hubungan_dalam_keluarga','kode_data_akta_lahirs.akta_lahir','kode_data_cacats.cacat','kode_data_cara_kbs.cara_kb')
	            ->where('Nomor_KK',Auth::user()->Nomor_KK)->get();
		$kode_area_dusuns=App\kode_area_dusun::where('id_dusun',$data_penduduks[0]->Id_Dusun)->get();
		
		
		return view('adminwarga',['users'=>$users,'barangdesas'=>$barangdesas,'jmlbarang'=>$jmlbarang,'data_penduduks' => $data_penduduks,'kode_area_dusuns' => $kode_area_dusuns]);

	}elseif(Auth::user()->roles == "member" && Auth::user()->status == "tidak aktif"){

		return view('auth/login')->with('pesan', 'Akun anda belum aktif');
	}
})->middleware('auth');

















