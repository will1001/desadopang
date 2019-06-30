@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
     <form action={{ url('editdatapendudukkadus/' .  $data_penduduks[0]->NIK ) }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Alamat :<br>
          <input type="text" name="Alamat" value="{{$data_penduduks[0]->Alamat}}"><br><br>
          RW :<br>
          <input type="text" name="RW" value="{{$data_penduduks[0]->RW}}"><br><br>
          RT :<br>
          <input type="text" name="RT" value="{{$data_penduduks[0]->RT}}"><br><br>
          Nama :<br>
          <input type="text" name="Nama" value="{{$data_penduduks[0]->Nama}}"><br><br>
          Nomor KK :<br>
          <input type="text" name="Nomor_KK" value="{{$data_penduduks[0]->No_KK}}"><br><br>
          Nomor NIK :<br>
          <input type="text" name="NIK" value="{{$data_penduduks[0]->NIK}}"><br><br>
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
               <option value="laki-laki">laki-laki</option>
               <option value="prempuan">prempuan</option>
          </select><br><br>
          Tempat Lahir :<br>
          <input type="text" name="Tempat_Lahir" value="{{$data_penduduks[0]->Tempat_Lahir}}"><br><br>
          Tanggal Lahir :<br>
           <input type="date" id="formattanggal" name="Tanggal_Lahir" value="{{$data_penduduks[0]->Tanggal_Lahir}}"><br><br>
          Agama :<br>
          <select name="Agama">
               <option value="Islam">Islam</option>
               <option value="Kristen">Kristen</option>
               <option value="Katolik">Katolik</option>
               <option value="Hindu">Hindu</option>
               <option value="Budha">Budha</option>
          </select><br><br>
          Pendidikan :<br>
          <input type="text" name="Pendidikan" value="{{$data_penduduks[0]->Pendidikan}}"><br><br>
          Jenis Pekerjaan :<br>
          <input type="text" name="Jenis_Pekerjaan" value="{{$data_penduduks[0]->Jenis_Pekerjaan}}"><br><br>
          Status Perkawinan :<br>
          <select name="Status_Perkawinan">
               <option value="Kawin">Kawin</option>
               <option value="Belum Kawin">Belum Kawin</option>
          </select><br><br>
          Status Hubungan Dalam Keluarga :<br>
          <select name="Status_Hubungan_Dalam_Keluarga">
               <option value="Kepala Keluarga">Kepala Keluarga</option>
               <option value="Istri">Istri</option>
               <option value="Anak">Anak</option>
          </select><br><br>
          Kewarganegaraan :<br>
          <select name="Kewarganegaraan">
               <option value="WNI">WNI</option>
               <option value="WNA">WNA</option>
          </select><br><br>
          Nama Ayah :<br>
          <input type="text" name="Nama_Ayah" value="{{$data_penduduks[0]->Nama_Ayah}}"><br><br>
          Nama Ibu :<br>
          <input type="text" name="Nama_Ibu" value="{{$data_penduduks[0]->Nama_Ibu}}"><br><br>
         Golongan darah :<br>
          <select name="Golongan_Darah">
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="AB">AB</option>
               <option value="O">O</option>
          </select><br><br>
          Akta Lahir :<br>
          <input type="text" name="Akta_Lahir" value="{{$data_penduduks[0]->Akta_Lahir}}"><br><br>
          Nomor Dokumen Paspor :<br>
          <input type="text" name="No_Paspor" value="{{$data_penduduks[0]->No_Paspor}}"><br><br>
          Tanggal akhir Paspor :<br>
          <input type="date" name="Tanggal_akhir_Paspor" value="{{$data_penduduks[0]->Tanggal_akhir_Paspor}}"><br><br>
          Nomor Dokumen KITAS :<br>
          <input type="text" name="No_KITAS" value="{{$data_penduduks[0]->No_KITAS}}"><br><br>
          NIK Ayah :<br>
          <input type="text" name="NIK_Ayah" value="{{$data_penduduks[0]->NIK_Ayah}}"><br><br>
          NIK Ibu :<br>
          <input type="text" name="NIK_Ibu" value="{{$data_penduduks[0]->NIK_Ibu}}"><br><br>
          No Akta Perkawinan :<br>
          <input type="text" name="No_Akta_Perkawinan" value="{{$data_penduduks[0]->No_Akta_Perkawinan}}"><br><br>
          Tanggal Perkawinan :<br>
          <input type="date" name="Tanggal_Perkawinan" value="{{$data_penduduks[0]->Tanggal_Perkawinan}}"><br><br>
          No Akta Perceraian :<br>
          <input type="text" name="No_Akta_Perceraian" value="{{$data_penduduks[0]->No_Akta_Perceraian}}"><br><br>
          Tanggal Perceraian :<br>
          <input type="date" name="Tanggal_Perceraian" value="{{$data_penduduks[0]->Tanggal_Perceraian}}"><br><br>
          Cacat :<br>
          <input type="text" name="Cacat" value="{{$data_penduduks[0]->Cacat}}"><br><br>
          Cara KB :<br>
          <input type="text" name="Cara_KB" value="{{$data_penduduks[0]->Cara_KB}}"><br><br>
          Hamil :<br>
          <input type="text" name="Hamil" value="{{$data_penduduks[0]->Hamil}}"><br><br>
          {{-- Status kependudukan :<br>
          <select name="status_kependudukan">
               <option selected="true" disabled="disabled">Status kependudukan</option>
               <option value="Datang">Datang</option>
               <option value="Lahir">Lahir</option>
               <option value="Pergi">Pergi</option>
               <option value="Meninggal">Meninggal</option>
          </select><br><br>
          Keterangan :<br>
          <textarea name="Keterangan"></textarea><br><br> --}}
          <input type="submit" value="Submit">
        </form>
        @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>


@endsection



    
        
  