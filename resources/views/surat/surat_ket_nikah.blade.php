

@extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('suratKetNikah')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Nama Desa :<br>
          <input type="text" name="NAMA_DES" value=""><br><br>
          Nama Kecamatan :<br>
          <input type="text" name="NAMA_KEC" value=""><br><br>
          Nama Kabupaten :<br>
          <input type="text" name="NAMA_KAB" value=""><br><br>
          Kode Surat :<br>
          <input type="text" name="kode_surat" value=""><br><br>
          Nomor Surat :<br>
          <input type="text" name="nomor_surat" value=""><br><br>
          Kode Desa :<br>
          <input type="text" name="kode_desa" value=""><br><br>
          Tahun :<br>
          <input type="text" name="tahun" value=""><br><br>
          Nama :<br>
          <input type="text" name="nama" value=""><br><br>
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
               <option value="laki-laki">laki-laki</option>
               <option value="prempuan">prempuan</option>
          </select><br><br>
          Tempat Lahir :<br>
          <input type="text" name="tempatlahir" placeholder="Tempat Lahir"><br><br>
          Tanggal Lahir :<br>
           <input type="date" id="formattanggal" name="tanggallahir" placeholder="Tanggal Lahir"><br><br>
           Kewarganegaraan :<br>
          <select name="kewarganegaraan">
               <option value="WNI">WNI</option>
               <option value="WNA">WNA</option>
          </select><br><br>
          Agama :<br>
          <select name="agama">
               <option value="Islam">Islam</option>
               <option value="Kristen">Kristen</option>
               <option value="Katolik">Katolik</option>
               <option value="Hindu">Hindu</option>
               <option value="Budha">Budha</option>
          </select><br><br>
          Pekerjaan :<br>
          <input type="text" name="pekerjaan" placeholder="Jenis Pekerjaan"><br><br>
          Alamat :<br>
          <textarea name="alamat"></textarea><br><br>
          Nama ayah :<br>
          <input type="text" name="nama_ayah" value=""><br><br>
          Status Perkawinan :<br>
          <select name="status_perkawinan">
               <option value="Kawin">Jejaka</option>
               <option value="Belum Kawin">duda</option>
               <option value="Belum Kawin">Beristri</option>
          </select><br><br>
          Jumlah Istri :<br>
          <input type="text" name="jml_istri" value=""><br><br>
          Nama suami atau Istri Dulu :<br>
          <input type="text" name="nama_suamiatauistri_dulu" value=""><br><br>
          Tanggal Surat :<br>
          <input type="date" id="formattanggal" name="tgl_surat" placeholder="Tanggal Lahir"><br><br>
          Jabatan :<br>
          <input type="text" name="jabatan" value=""><br><br>
          Nama Pamong :<br>
          <input type="text" name="nama_pamong" value=""><br><br>

          
          <input type="submit" value="Submit">
        </form>
		</div>
	</div>
</div>

@endsection