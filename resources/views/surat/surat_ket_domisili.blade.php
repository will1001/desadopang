

@extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('surat_ket_domisili')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}

          Alamat Desa :<br>
          <textarea name="alamat_desa"></textarea><br><br>
          Tahun :<br>
          <input type="text" name="tahun" value=""><br><br>
          Nama :<br>
          <input type="text" name="nama" value="{{$data_penduduks[0]->Nama}}"><br><br>
          NIK No. KTP :<br>
          <input type="text" name="no_ktp" value="{{$data_penduduks[0]->NIK}}"><br><br>
          No. kk :<br>
          <input type="text" name="no_KK" value="{{$data_penduduks[0]->Nomor_KK}}"><br><br>
          Kepala Keluarga :<br>
          <input type="text" name="kepala_kk" value=""><br><br>
          Tempat Lahir :<br>
          <input type="text" name="tempatlahir" value="{{$data_penduduks[0]->Tempat_Lahir}}"><br><br>
          Tanggal Lahir :<br>
           <input type="date" id="formattanggal" name="tanggallahir" value="{{$data_penduduks[0]->Tanggal_Lahir}}"><br><br>
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
               <option value="laki-laki">laki-laki</option>
               <option value="prempuan">prempuan</option>
          </select><br><br>
          Agama :<br>
          <select name="agama">
               <option value="Islam">Islam</option>
               <option value="Kristen">Kristen</option>
               <option value="Katolik">Katolik</option>
               <option value="Hindu">Hindu</option>
               <option value="Budha">Budha</option>
          </select><br><br>
          Status Perkawinan :<br>
          <select name="status_perkawinan">
               <option value="Kawin">Kawin</option>
               <option value="Belum Kawin">Belum Kawin</option>
          </select><br><br>
          Pendidikan :<br>
          <select name="pendidikan">
               <option value="SD">SD</option>
               <option value="SMP">SMP</option>
               <option value="SMA">SMA</option>
               <option value="D3">D3</option>
               <option value="S1">S1</option>
               <option value="S2">S2</option>
               <option value="S3">S3</option>
          </select><br><br>
          Pekerjaan :<br>
          <input type="text" name="pekerjaan" value="{{$data_penduduks[0]->Jenis_Pekerjaan}}"><br><br>
           Kewarganegaraan :<br>
          <select name="kewarganegaraan">
               <option value="WNI">WNI</option>
               <option value="WNA">WNA</option>
          </select><br><br>
          Alamat :<br>
          <textarea name="alamat">{{$data_penduduks[0]->Alamat}}</textarea><br><br>
          RT :<br>
          <input type="text" name="rt" value="{{$data_penduduks[0]->RT}}"><br><br>
          RW :<br>
          <input type="text" name="rw" value="{{$data_penduduks[0]->RW}}"><br><br>
          Dusun :<br>
          <input type="text" name="dusun" value="{{$kode_area_dusuns[0]->Nama_Dusun}}"><br><br>
          Keperluan surat :<br>
          <input type="text" name="keperluan" value=""><br><br>
          Tanggal Surat :<br>
          <input type="date" id="formattanggal" name="tgl_surat" placeholder="Tanggal Lahir"><br><br>
          
          

          
          <input type="submit" value="Submit">
        </form>
		</div>
	</div>
</div>

@endsection