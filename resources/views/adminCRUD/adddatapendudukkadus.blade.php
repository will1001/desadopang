 @extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
     <form action="{{url('adddatapendudukkadus')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Alamat :<br>
          <input type="text" name="Alamat" placeholder="Alamat"><br><br>
          RW :<br>
          <input type="text" name="RW" placeholder="RW"><br><br>
          RT :<br>
          <input type="text" name="RT" placeholder="RT"><br><br>
          Nama :<br>
          <input type="text" name="Nama" placeholder="Nama"><br><br>
          Nomor KK :<br>
          <input type="text" name="Nomor_KK" placeholder="Nomor KK"><br><br>
          Nomor NIK :<br>
          <input type="text" name="NIK" placeholder="NIK"><br><br>
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
               <option selected="true" disabled="disabled">Jenis Kelamin</option>                 
               <option value="laki-laki">laki-laki</option>
               <option value="prempuan">prempuan</option>
          </select><br><br>
          Tempat Lahir :<br>
          <input type="text" name="Tempat_Lahir" placeholder="Tempat Lahir"><br><br>
          Tanggal Lahir :<br>
           <input type="date" id="formattanggal" name="Tanggal_Lahir" placeholder="Tanggal Lahir"><br><br>
          Agama :<br>
          <select name="Agama">
               <option value="Islam">Islam</option>
               <option value="Kristen">Kristen</option>
               <option value="Katolik">Katolik</option>
               <option value="Hindu">Hindu</option>
               <option value="Budha">Budha</option>
          </select><br><br>
          Pendidikan :<br>
          <input type="text" name="Pendidikan" placeholder="Pendidikan"><br><br>
          Jenis Pekerjaan :<br>
          <input type="text" name="Jenis_Pekerjaan" placeholder="Jenis Pekerjaan"><br><br>
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
          <input type="text" name="Nama_Ayah" placeholder="Nama Ayah"><br><br>
          Nama Ibu :<br>
          <input type="text" name="Nama_Ibu" placeholder="Nama Ibu"><br><br>
          Golongan darah :<br>
          <select name="Golongan_Darah">
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="AB">AB</option>
               <option value="O">O</option>
          </select><br><br>
          Akta Lahir :<br>
          <input type="text" name="Akta_Lahir" placeholder="Akta Lahir"><br><br>
          Nomor Dokumen Paspor :<br>
          <input type="text" name="No_Paspor" placeholder="No Dokumen Paspor"><br><br>
          Tanggal akhir Paspor :<br>
          <input type="date" name="Tanggal_akhir_Paspor" placeholder="No Tanggal akhir Paspor"><br><br>
          Nomor Dokumen KITAS :<br>
          <input type="text" name="No_KITAS" placeholder="Nomor Dokumen KITAS"><br><br>
          NIK Ayah :<br>
          <input type="text" name="NIK_Ayah" placeholder="NIK Ayah"><br><br>
          NIK Ibu :<br>
          <input type="text" name="NIK_Ibu" placeholder="NIK Ibu"><br><br>
          No Akta Perkawinan :<br>
          <input type="text" name="No_Akta_Perkawinan" placeholder="No Akta Perkawinan"><br><br>
          Tanggal Perkawinan :<br>
          <input type="date" name="Tanggal_Perkawinan" placeholder="Tanggal Perkawinan"><br><br>
          No Akta Perceraian :<br>
          <input type="text" name="No_Akta_Perceraian" placeholder="No Akta Perceraian"><br><br>
          Tanggal Perceraian :<br>
          <input type="date" name="Tanggal_Perceraian" placeholder="Tanggal Perceraian"><br><br>
          Cacat :<br>
          <input type="text" name="Cacat" placeholder="Cacat"><br><br>
          Cara KB :<br>
          <input type="text" name="Cara_KB" placeholder="Cara KB"><br><br>
          Hamil :<br>
          <input type="text" name="Hamil" placeholder="Hamil"><br><br>
         
          <input type="submit" value="Submit">
        </form>
        @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>

@endsection