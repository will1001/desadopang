 @extends('layouts.layoutform')

@section('content')



<section class="section-padding">
  <div class="container">
    <div class="row">
      <h1 class="text-center">Detail Data Penduduk</h1>
      <div class="col-md-6">
        <p><strong>Alamat : </strong>{{$data_penduduks[0]->Alamat}}</p>
        <p><strong>Dusun : </strong>{{$kode_area_dusuns[0]->Nama_Dusun}}</p>
        <p><strong>RW : </strong>{{$data_penduduks[0]->RW}}</p>
        <p><strong>RT : </strong>{{$data_penduduks[0]->RT}}</p>
        <p><strong>Nama : </strong>{{$data_penduduks[0]->Nama}}</p>
        <p><strong>Nomor KK : </strong>{{$data_penduduks[0]->Nomor_KK}}</p>
        <p><strong>NIK : </strong>{{$data_penduduks[0]->NIK}}</p>
        <p><strong>JENIS KELAMIN : </strong>{{$data_penduduks[0]->Jenis_Kelamin}}</p>
        <p><strong>TEMPAT LAHIR : </strong>{{$data_penduduks[0]->Tempat_Lahir}}</p>
        <p><strong>TANGGAL LAHIR : </strong>{{$data_penduduks[0]->Tanggal_Lahir}}</p>
        <p><strong>AGAMA : </strong>{{$data_penduduks[0]->Agama}}</p>
        <p><strong>PENDIDIKAN : </strong>{{$data_penduduks[0]->Pendidikan}}</p>
        <p><strong>JENIS PEKERJAAN : </strong>{{$data_penduduks[0]->Jenis_Pekerjaan}}</p>
        <p><strong>STATUS PERKAWINAN : </strong>{{$data_penduduks[0]->Status_Perkawinan}}</p>
        <p><strong>STATUS HUBUNGAN DALAM MASYARAKAT : </strong>{{$data_penduduks[0]->Status_Hubungan_Dalam_Keluarga}}</p>
        <p><strong>KEWARGANEGARAAN : </strong>{{$data_penduduks[0]->Kewarganegaraan}}</p>
        <p><strong>AYAH : </strong>{{$data_penduduks[0]->Nama_Ayah}}</p>
      </div>
      <div class="col-md-6">
        <p><strong>IBU : </strong>{{$data_penduduks[0]->Nama_Ibu}}</p>
        <p><strong>Golongan_Darah : </strong>{{$data_penduduks[0]->Golongan_Darah}}</p>
        <p><strong>Akta_Lahir : </strong>{{$data_penduduks[0]->Akta_Lahir}}</p>
        <p><strong>No_Paspor : </strong>{{$data_penduduks[0]->No_Paspor}}</p>
        <p><strong>Tanggal_akhir_Paspor : </strong>{{$data_penduduks[0]->Tanggal_akhir_Paspor}}</p>
        <p><strong>No_KITAS : </strong>{{$data_penduduks[0]->No_KITAS}}</p>
        <p><strong>NIK_Ayah : </strong>{{$data_penduduks[0]->NIK_Ayah}}</p>
        <p><strong>NIK_Ibu : </strong>{{$data_penduduks[0]->NIK_Ibu}}</p>
        <p><strong>No_Akta_Perkawinan : </strong>{{$data_penduduks[0]->No_Akta_Perkawinan}}</p>
        <p><strong>Tanggal_Perkawinan : </strong>{{$data_penduduks[0]->Tanggal_Perkawinan}}</p>
        <p><strong>No_Akta_Perceraian : </strong>{{$data_penduduks[0]->No_Akta_Perceraian}}</p>
        <p><strong>Tanggal_Perceraian : </strong>{{$data_penduduks[0]->Tanggal_Perceraian}}</p>
        <p><strong>Cacat : </strong>{{$data_penduduks[0]->Cacat}}</p>
        <p><strong>Cara_KB : </strong>{{$data_penduduks[0]->Cara_KB}}</p>
        <p><strong>Hamil : </strong>{{$data_penduduks[0]->Hamil}}</p>
        <p><strong>STATUS KEPENDUDUKAN : </strong>{{$data_penduduks[0]->Status_kependudukan}}</p>
        <p><strong>KETERANGAN : </strong>{{$data_penduduks[0]->Keterangan}}</p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="{{url('postpenduduk_keluar/'.$data_penduduks[0]->NIK)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            STATUS KEPENDUDUKAN :
            <select name="status_kependudukan">
                   
                   <option value="Datang">Datang</option>
                   <option value="Lahir">Lahir</option>
                   <option value="Pergi">Pergi</option>
                   <option value="Meninggal">Meninggal</option>
              </select><br>
             KETERANGAN : <br>
            <textarea name="keterangan"></textarea><br>
            <input type="submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>        
  

        
@endsection


    
        