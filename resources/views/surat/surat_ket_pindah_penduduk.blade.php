

@extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
          <form action="{{ url('surat_ket_pindah_penduduk')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
			
          Nama Desa :<br>
          <input type="text" name="nama_des" value=""><br><br>
          Nama Kecamatan :<br>
          <input type="text" name="nama_kec" value=""><br><br>
          Nama Kabupaten :<br>
          <input type="text" name="nama_kab" value=""><br><br>
          Nama Propinsi :<br>
          <input type="text" name="nama_prov" value=""><br><br>
          Alamat Desa :<br>
          <textarea name="alamat_desa"></textarea><br><br>
          Tahun :<br>
          <input type="text" name="tahun" value=""><br><br>
          Nama :<br>
          <input type="text" name="nama" value=""><br><br>
          Tempat Lahir :<br>
          <input type="text" name="tempatlahir" placeholder="Tempat Lahir"><br><br>
          Tanggal Lahir :<br>
          <input type="date" id="formattanggal" name="tanggallahir" placeholder="Tanggal Lahir"><br><br>
          Umur :<br>
          <input type="text" name="umur" value=""><br><br>
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
          Jenis Kelamin :<br>
          <select name="jenis_kelamin">
               <option value="laki-laki">laki-laki</option>
               <option value="prempuan">prempuan</option>
          </select><br><br>
          Pekerjaan :<br>
          <input type="text" name="pekerjaan" placeholder="Jenis Pekerjaan"><br><br>
          No. KTP :<br>
          <input type="text" name="no_ktp" value=""><br><br>
          Alamat :<br>
          <textarea name="alamat"></textarea><br><br>
          RT :<br>
          <input type="text" name="rt" value=""><br><br>
          RW :<br>
          <input type="text" name="rw" value=""><br><br>
          Dusun :<br>
          <input type="text" name="dusun" value=""><br><br>

          
          Alamat Tujuan :<br>
          <textarea name="alamat_tujuan"></textarea><br><br>
          RT Tujuan :<br>
          <input type="text" name="rt_tujuan" value=""><br><br>
          RW Tujuan :<br>
          <input type="text" name="rw_tujuan" value=""><br><br>
          Dusun Tujuan :<br>
          <input type="text" name="dusun_tujuan" value=""><br><br>
          Desa Tujuan :<br>
          <input type="text" name="desa_tujuan" value=""><br><br>
          Kecamatan Tujuan :<br>
          <input type="text" name="kecamatan_tujuan" value=""><br><br>
          Kabupaten Tujuan :<br>
          <input type="text" name="kabupaten_tujuan" value=""><br><br>
          alasan pindah :<br>
          <textarea name="alasan_pindah"></textarea><br><br>
          Tanggal pindah :<br>
          <input type="date" name="tgl_pindah" value=""><br><br>
          Keperluan surat :<br>
          <input type="text" name="keperluan" value=""><br><br>
          Tanggal Surat :<br>
          <input type="date" id="formattanggal" name="tgl_surat" placeholder="Tanggal Lahir"><br><br>
          

          
          </div>
          <div class="col-md-10" style="padding-top: 100px;">
          <div class="row">
               <div class="col-md-10 text-center">
                    <strong>Keluarga yang akan pindah :</strong> <br><br>
          
                    <div class="text-left">
                         1. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik1" value="">
                         <input type="text" name="pindahnama1" value="">
                         <input type="date" name="ktpberlaku1" value="">
                         <input type="text" name="pindahshdk1" value="">
                         <br><br>

                         2. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik2" value="">
                         <input type="text" name="pindahnama2" value="">
                         <input type="date" name="ktpberlaku2" value="">
                         <input type="text" name="pindahshdk2" value="">
                         <br><br>

                         3. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik3" value="">
                         <input type="text" name="pindahnama3" value="">
                         <input type="date" name="ktpberlaku3" value="">
                         <input type="text" name="pindahshdk3" value="">
                         <br><br>

                         4. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik4" value="">
                         <input type="text" name="pindahnama4" value="">
                         <input type="date" name="ktpberlaku4" value="">
                         <input type="text" name="pindahshdk4" value="">
                         <br><br>

                         5. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik5" value="">
                         <input type="text" name="pindahnama5" value="">
                         <input type="date" name="ktpberlaku5" value="">
                         <input type="text" name="pindahshdk5" value="">
                         <br><br>

                         6. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik6" value="">
                         <input type="text" name="pindahnama6" value="">
                         <input type="date" name="ktpberlaku6" value="">
                         <input type="text" name="pindahshdk6" value="">
                         <br><br>

                         7. NIK : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-5"></span> 
                         Nama : 
                         <span class="mr-5"></span><span class="mr-5"></span><span class="mr-4"></span><span class="mr-3"></span> 
                         Masa Berlaku KTP S/D : 
                         <span class="mr-2"></span> 
                         SHDK : <br>
                         <span class="ml-3"></span>
                         <input type="text" name="pindahnik7" value="">
                         <input type="text" name="pindahnama7" value="">
                         <input type="date" name="ktpberlaku7" value="">
                         <input type="text" name="pindahshdk7" value="">
                         <br><br>
                         <input type="submit" value="Submit">
                    </div>


               </div>
          </div>
          
          
		</div>
          </form>
	</div>
</div>

@endsection