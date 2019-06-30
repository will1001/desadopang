@extends('layouts.layoutform')

@section('content')

<br><br><br><br> 

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 text-center">
      @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  <div class="row">

    <div class="col-md-4">
      
     <form action="{{ url('editdatapendudukwarga/' .  $data_penduduks[0]->NIK .'/'.$data_penduduks[0]->Id_Dusun ) }}" method="post" enctype="multipart/form-data" class="padding_form">
          {{ csrf_field() }}
          Alamat :<br>
          <input type="text" name="Alamat" value="{{$data_penduduks[0]->Alamat}}"><br><br>
          Dusun :<br>
          <select name="Id_Dusun">
                 <option selected="true" value="{{ $kode_area_dusun_defaults[0]->id_dusun }}">{{ $kode_area_dusun_defaults[0]->Nama_Dusun }}</option>
                 @foreach ($kode_area_dusuns as $kode_area_dusun)
                    <option value="{{ $kode_area_dusun->id_dusun }}">{{ $kode_area_dusun->Nama_Dusun }}</option>
                 @endforeach
          </select><br><br>
          RW :<br>
          <input type="text" name="RW" value="{{$data_penduduks[0]->RW}}"><br><br>
          RT :<br>
          <input type="text" name="RT" value="{{$data_penduduks[0]->RT}}"><br><br>
          Nama :<br>
          <input type="text" name="Nama" value="{{$data_penduduks[0]->Nama}}"><br><br>
          Nomor KK :<br>
          <input type="text" name="Nomor_KK" value="{{$data_penduduks[0]->Nomor_KK}}"><br><br>
          Nomor NIK :<br>
          <input type="text" name="NIK" value="{{$data_penduduks[0]->NIK}}"><br><br>
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
            <option selected="true" value="{{ $tabel_jenis_kelamin_defaults[0]->id }}">{{ $tabel_jenis_kelamin_defaults[0]->jenis_kelamin }}</option>
               @foreach ($tabel_jenis_kelamins as $tabel_jenis_kelamin)
                    <option value="{{ $tabel_jenis_kelamin->id }}">{{ $tabel_jenis_kelamin->jenis_kelamin }}</option>
                 @endforeach
          </select><br><br>
          Tempat Lahir :<br>
          <input type="text" name="Tempat_Lahir" value="{{$data_penduduks[0]->Tempat_Lahir}}"><br><br>
          Tanggal Lahir :<br>
           <input type="date" id="formattanggal" name="Tanggal_Lahir" value="{{date('Y-m-d', strtotime($data_penduduks[0]->Tanggal_Lahir))}}"><br><br>
          Agama :<br>
          <select name="Agama">
            <option selected="true" value="{{ $tabel_agama_defaults[0]->id }}">{{ $tabel_agama_defaults[0]->agama }}</option>
               @foreach ($tabel_agamas as $tabel_agama)
                    <option value="{{ $tabel_agama->id }}">{{ $tabel_agama->agama }}</option>
                 @endforeach
          </select><br><br>
          Pendidikan :<br>
          <select name="Pendidikan">
            <option selected="true" value="{{ $tabel_pendidikan_defaults[0]->id }}">{{ $tabel_pendidikan_defaults[0]->pendidikan }}</option>
               @foreach ($tabel_pendidikans as $tabel_pendidikan)
                    <option value="{{ $tabel_pendidikan->id }}">{{ $tabel_pendidikan->pendidikan }}</option>
                 @endforeach
          </select><br><br>
          Jenis Pekerjaan :<br>
          <select name="Jenis_Pekerjaan">
            <option selected="true" value="{{ $tabel_jenis_pekerjaan_defaults[0]->id }}">{{ $tabel_jenis_pekerjaan_defaults[0]->jenis_pekerjaan }}</option>
               @foreach ($tabel_jenis_pekerjaans as $tabel_jenis_pekerjaan)
                    <option value="{{ $tabel_jenis_pekerjaan->id }}">{{ $tabel_jenis_pekerjaan->jenis_pekerjaan }}</option>
                 @endforeach
          </select><br><br>
          Status Perkawinan :<br>
          <select name="Status_Perkawinan">
            <option selected="true" value="{{ $tabel_status_perkawinan_defaults[0]->id }}">{{ $tabel_status_perkawinan_defaults[0]->status_perkawinan }}</option>
               @foreach ($tabel_status_perkawinans as $tabel_status_perkawinan)
                    <option value="{{ $tabel_status_perkawinan->id }}">{{ $tabel_status_perkawinan->status_perkawinan }}</option>
                 @endforeach
          </select><br><br>
          Status Hubungan Dalam Keluarga :<br>
          <select name="Status_Hubungan_Dalam_Keluarga">
               <option selected="true" value="{{ $tabel_status_hubungan_dalam_keluarga_defaults[0]->id }}">{{ $tabel_status_hubungan_dalam_keluarga_defaults[0]->status_hubungan_dalam_keluarga }}</option>
               @foreach ($tabel_status_hubungan_dalam_keluargas as $tabel_status_hubungan_dalam_keluarga)
                    <option value="{{ $tabel_status_hubungan_dalam_keluarga->id }}">{{ $tabel_status_hubungan_dalam_keluarga->status_hubungan_dalam_keluarga }}</option>
                 @endforeach
          </select><br><br>
          Kewarganegaraan :<br>
          <select name="Kewarganegaraan">
            <option selected="true" value="{{ $tabel_kewarganegaraan_defaults[0]->id }}">{{ $tabel_kewarganegaraan_defaults[0]->kewarganegaraan }}</option>
                @foreach ($tabel_kewarganegaraans as $tabel_kewarganegaraan)
                    <option value="{{ $tabel_kewarganegaraan->id }}">{{ $tabel_kewarganegaraan->kewarganegaraan }}</option>
                 @endforeach
          </select><br><br>
          Nama Ayah :<br>
          <input type="text" name="Nama_Ayah" value="{{$data_penduduks[0]->Nama_Ayah}}"><br><br>
          Nama Ibu :<br>
          <input type="text" name="Nama_Ibu" value="{{$data_penduduks[0]->Nama_Ibu}}"><br><br>
          Golongan darah :<br>
          <select name="Golongan_Darah">
            <option selected="true" value="{{ $tabel_golongan_darah_defaults[0]->id }}">{{ $tabel_golongan_darah_defaults[0]->golongan_darah }}</option>
                @foreach ($tabel_golongan_darahs as $tabel_golongan_darah)
                    <option value="{{ $tabel_golongan_darah->id }}">{{ $tabel_golongan_darah->golongan_darah }}</option>
                 @endforeach
          </select><br><br>
           </div>
          <div class="col-md-4">
          Akta Lahir :<br>
          <input type="text" name="Akta_Lahir" value="{{$data_penduduks[0]->Akta_Lahir}}"><br><br>
          Nomor Dokumen Paspor :<br>
          <input type="text" name="No_Paspor" value="{{$data_penduduks[0]->No_Paspor}}"><br><br>
          Tanggal akhir Paspor :<br>
          <input type="date" name="Tanggal_akhir_Paspor" value="{{date('Y-m-d', strtotime($data_penduduks[0]->Tanggal_akhir_Paspor))}}"><br><br>
          Nomor Dokumen KITAS :<br>
          <input type="text" name="No_KITAS" value="{{$data_penduduks[0]->No_KITAS}}"><br><br>
          NIK Ayah :<br>
          <input type="text" name="NIK_Ayah" value="{{$data_penduduks[0]->NIK_Ayah}}"><br><br>
          NIK Ibu :<br>
          <input type="text" name="NIK_Ibu" value="{{$data_penduduks[0]->NIK_Ibu}}"><br><br>
          No Akta Perkawinan :<br>
          <input type="text" name="No_Akta_Perkawinan" value="{{$data_penduduks[0]->No_Akta_Perkawinan}}"><br><br>
          Tanggal Perkawinan :<br>
          <input type="date" name="Tanggal_Perkawinan" value="{{date('Y-m-d', strtotime($data_penduduks[0]->Tanggal_Perkawinan))}}"><br><br>
          No Akta Perceraian :<br>
          <input type="text" name="No_Akta_Perceraian" value="{{$data_penduduks[0]->No_Akta_Perceraian}}"><br><br>
          Tanggal Perceraian :<br>
          <input type="date" name="Tanggal_Perceraian" value="{{date('Y-m-d', strtotime($data_penduduks[0]->Tanggal_Perceraian))}}"><br><br>
          Cacat :<br>
          <input type="text" name="Cacat" value="{{$data_penduduks[0]->Cacat}}"><br><br>
          Cara KB :<br>     
          <select name="Cara_KB">
            <option selected="true" value="{{$data_penduduks[0]->Cara_KB}}">{{$data_penduduks[0]->Cara_KB}}</option>
              <option value="Pil">Pil</option>
              <option value="IUD">IUD</option>
              <option value="Suntik">Suntik</option>
              <option value="Kondom">Kondom</option>
              <option value="Susuk KB">Susuk KB</option>
              <option value="Sterilisasi Wanita">Sterilisasi Wanita</option>
              <option value="Sterilisasi Pria">Sterilisasi Pria</option>
               </select><br><br>
          Hamil :<br>
          <input type="text" name="Hamil" value="{{$data_penduduks[0]->Hamil}}"><br><br>
          Tempat Mendapatkan Air Bersih :<br>
          <select name="tempat_mendapatkan_air_bersih">
               <option selected="true" value="{{$data_penduduks[0]->tempat_mendapatkan_air_bersih}}">{{$data_penduduks[0]->tempat_mendapatkan_air_bersih}}</option>                 
               <option value="PAM">PAM</option>
               <option value="Sumur Gali">Sumur Gali</option>
               <option value="Penampungan air hujan">Penampungan air hujan</option>
               <option value="Air sungai">Air sungai</option>
               <option value="Embung">Embung</option>
               <option value="Sumur pompa">Sumur pompa</option>
               <option value="Perpipaan air keran">Perpipaan air keran</option>
               <option value="Hidran umum">Hidran umum</option>
               <option value="Mata air">Mata air</option>
               <option value="Air laut">Air laut</option>
          </select><br><br>
          Status Gizi Balita :<br>
          <select name="status_gizi_balita">
               <option selected="true" value="{{$data_penduduks[0]->status_gizi_balita}}">{{$data_penduduks[0]->status_gizi_balita}}</option>                 
               <option value="Baik">Baik</option>
               <option value="Buruk">Buruk</option>
               <option value="Kurang">Kurang</option>
               <option value="Lebih">Lebih</option>
          </select><br><br>
          Kebiasaan Berobat Bila Sakit :<br>
          <select name="kebiasaan_berobat_bila_sakit">
               <option selected="true" value="{{$data_penduduks[0]->kebiasaan_berobat_bila_sakit}}">{{$data_penduduks[0]->kebiasaan_berobat_bila_sakit}}</option>                 
               <option value="Dokter">Dokter</option>
               <option value="Dukun terlatih">Dukun terlatih</option>
               <option value="Keluarga sendiri">Keluarga sendiri</option>
               <option value="Paranormal">Paranormal</option>
               <option value="Tidak berobat">Tidak berobat</option>
          </select><br><br>
           </div>
          <div class="col-md-4">
          Sumber Air Minum :<br>
          <input type="text" name="Sumber Air Minum" placeholder="Sumber Air Minum"><br><br>
          Kualitas Air Minum :<br>
          <input type="text" name="Kualitas Air Minum" placeholder="Kualitas Air Minum"><br><br>
          Kualitas Ibu Hamil :<br>
          <input type="text" name="Kualitas Ibu Hamil" placeholder="Kualitas Ibu Hamil"><br><br>
          Kualitas Bayi :<br>
          <input type="text" name="Kualitas Bayi" placeholder="Kualitas Bayi"><br><br>
          Tempat Persalinan :<br>
          <input type="text" name="Tempat Persalinan" placeholder="Tempat Persalinan"><br><br>
          Portolongan Persalinan :<br>
          <input type="text" name="Portolongan Persalinan" placeholder="Portolongan Persalinan"><br><br>
          Cakupan Imunisasi :<br>
          <input type="text" name="Cakupan Imunisasi" placeholder="Cakupan Imunisasi"><br><br>
          Perilaku Hidup Bersih :<br>
          <input type="text" name="Perilaku Hidup Bersih" placeholder="Perilaku Hidup Bersih"><br><br>
          Pola Makan :<br>
          <input type="text" name="Pola Makan" placeholder="Pola Makan"><br><br>
          Penyakit yang di derita :<br>
          <input type="text" name="Penyakit yang di derita" placeholder="Penyakit yang di derita"><br><br>
          Upload foto KTP : <br><br>
          <input type="file" name="foto_ktp" id="foto_ktp"><br><br>
          Upload foto KK : <br><br>
          <input type="file" name="foto_kk" id="foto_kk">
          <br><br>

          
          
          <input type="submit" value="Submit">
        </form>
        
    </div>
  </div>
</div>


@endsection



    
        
  