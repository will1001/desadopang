<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Desa Dopang</title>

  <!-- Custom fonts for this template-->
  <link href="\admincss\vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="\admincss\vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="\admincss\css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/responsiveadmin.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/table.css')}}">


  <style>
    #logotext{
    text-transform: uppercase;
    font-weight: bold;
    line-height: 33px;
    font-size: 20px;
    
    }

    #logotext2{
        text-transform: uppercase;
        font-size: 9px;
        line-height: 5px;
        
    }
    #spacetextlogo{
        display: inline-grid;
    }

    #usernote{
      margin: 0px -18px;
    }

    #logo{
      margin: 0px -9px;

position: relative;
    }
  </style>

</head>

<body id="page-top">

  


  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" style="position: fixed;">
      <div id="logo">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img src="/images/Kabupaten_Lombok_Tengah.png" width="50" height="50" class="d-inline-block align-top" alt="">
    <div id="spacetextlogo">
    <span id="logotext" class="text-light">DESA DOPANG</span>
    <span id="logotext2" class="text-light">PORTAL RESMI PEMERINTAH DESA</span>
    </div>
  </a>
  </div>
</div>
     
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user"></i>
          <span>{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
     @php
  $no=1
@endphp



<section class="section-padding" id="biodata">
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Nomor KK : {{ $data_penduduks[0]->Nomor_KK }}</h1><br><br>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">


        <div style="overflow: auto;max-height: 400px;position: relative;  ">
      <table id="tabeldatakadus">
      <thead>
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <col width="1000px">
        <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Alamat</th>
                  <th rowspan="2">RW</th>
                  <th rowspan="2">RT</th>
                  <th rowspan="2">Nama</th>
                  <th rowspan="2">Nomor KK</th>
                  <th rowspan="2">Nomor NIK</th>
                  <th rowspan="2">Jenis Kelamin</th>
                  <th rowspan="2">Tempat Lahir</th>
                  <th rowspan="2">Tanggal Lahir</th>
                  <th rowspan="2">Usia</th>
                  <th rowspan="2">Agama</th>
                  <th rowspan="2">Pendidikan</th>
                  <th rowspan="2">Jenis Pekerjaan</th> 
                  <th rowspan="2">Status Perkawinan</th> 
                  <th rowspan="2">Status Hubungan Dalam Keluarga</th> 
                  <th rowspan="2">Kewarganegaraan</th> 
                  <th rowspan="2">Nama Ayah</th> 
                  <th rowspan="2">Nama Ibu</th> 
                  <th rowspan="2">Golongan Darah</th> 
                  <th rowspan="2">Akta Lahir</th> 
                  <th rowspan="2">Nomor Dokumen Paspor</th>
                  <th rowspan="2">Tanggal Akhir Paspor</th>  
                  <th rowspan="2">Nomor Dokumen KITAS</th>             
                  <th rowspan="2">NIK Ayah</th> 
                  <th rowspan="2">NIK Ibu</th> 
                  <th rowspan="2">No Akta Perkawinan</th> 
                  <th rowspan="2">Tanggal Perkawinan</th> 
                  <th rowspan="2">No Akta Perceraian</th> 
                  <th rowspan="2">Tanggal Perceraian</th> 
                  <th rowspan="2">Cacat</th> 
                  <th rowspan="2">Cara KB</th> 
                  <th rowspan="2">Hamil</th> 
                  <th rowspan="2">Status kependudukan</th> 
                  <th rowspan="2">Keterangan</th>  
                  <th rowspan="2">Tempat Mendapatkan Air Bersih</th>  
                  <th rowspan="2">Status Gizi Balita</th>  
                  <th rowspan="2">Kebiasaan Berobat Bila Sakit</th>   
                  <!-- <th colspan="5">Pendapatan Perkapita</th>    -->
                  <!-- <th colspan="5">Pendapatan Rill Keluarga</th>    -->
                  <th rowspan="2">Foto KTP</th>  
                  <th rowspan="2">Foto KK</th>   
                  <th rowspan="2">edit</th>  
        </tr>
      </thead>
      <tbody id="tbodytabel">
        @php
        $no=1
        @endphp
        @foreach($data_penduduks as $data_penduduk)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data_penduduk->Alamat }}</td>
            <td>{{ $data_penduduk->RW }}</td>
            <td>{{ $data_penduduk->RT }}</td>
            <td>{{ $data_penduduk->Nama }}</td>
            <td>{{ $data_penduduk->Nomor_KK }}</td>
            <td>{{ $data_penduduk->NIK }}</td>
            <td>{{ $data_penduduk->jenis_kelamin }}</td>
            <td>{{ $data_penduduk->Tempat_Lahir }}</td>
            <td>{{ $data_penduduk->Tanggal_Lahir }}</td>
            <td>{{ $data_penduduk->Usia }}</td>
            <td>{{ $data_penduduk->agama }}</td>
            <td>{{ $data_penduduk->pendidikan }}</td>
            <td>{{ $data_penduduk->jenis_pekerjaan }}</td>
            <td>{{ $data_penduduk->status_perkawinan }}</td>
            <td>{{ $data_penduduk->status_hubungan_dalam_keluarga }}</td>
            <td>{{ $data_penduduk->kewarganegaraan }}</td>
            <td>{{ $data_penduduk->Nama_Ayah }}</td>
            <td>{{ $data_penduduk->Nama_Ibu }}</td>
            <td>{{ $data_penduduk->golongan_darah }}</td>
            <td>{{ $data_penduduk->Akta_Lahir }}</td>
            <td>{{ $data_penduduk->No_Paspor }}</td>
            <td>{{ $data_penduduk->Tanggal_akhir_Paspor }}</td>
            <td>{{ $data_penduduk->No_KITAS }}</td>
            <td>{{ $data_penduduk->NIK_Ayah }}</td>
            <td>{{ $data_penduduk->NIK_Ibu }}</td>
            <td>{{ $data_penduduk->No_Akta_Perkawinan }}</td>
            <td>{{ $data_penduduk->Tanggal_Perkawinan }}</td>
            <td>{{ $data_penduduk->No_Akta_Perceraian }}</td>
            <td>{{ $data_penduduk->Tanggal_Perceraian }}</td>
            <td>{{ $data_penduduk->Cacat }}</td>
            <td>{{ $data_penduduk->Cara_KB }}</td>
            <td>{{ $data_penduduk->Hamil }}</td>
            <td>{{ $data_penduduk->Status_kependudukan }}</td>
            <td>{{ $data_penduduk->Keterangan }}</td>
            <td>{{ $data_penduduk->tempat_mendapatkan_air_bersih }}</td>
            <td>{{ $data_penduduk->status_gizi_balita }}</td>
            <td>{{ $data_penduduk->kebiasaan_berobat_bila_sakit }}</td>
            @if($data_penduduk->foto_ktp==null && $data_penduduk->foto_kk==null )
            <td ><a href="{{$data_penduduk->foto_ktp}}"></a></td>        
            <td ><a href="{{$data_penduduk->foto_kk}}"></a></td>
            @endif
            @if($data_penduduk->foto_ktp==null && $data_penduduk->foto_kk!=null)
            <td ><a href="{{$data_penduduk->foto_ktp}}"></a></td>        
            <td ><a href="{{$data_penduduk->foto_kk}}">lihat</a></td>
            @endif
            @if($data_penduduk->foto_ktp!=null && $data_penduduk->foto_kk==null)
            <td ><a href="{{$data_penduduk->foto_ktp}}">lihat</a></td>        
            <td ><a href="{{$data_penduduk->foto_kk}}"></a></td>
            @endif
            @if($data_penduduk->foto_ktp!=null && $data_penduduk->foto_kk!=null)
            <td ><a href="{{$data_penduduk->foto_ktp}}">lihat</a></td>        
            <td ><a href="{{$data_penduduk->foto_kk}}">lihat</a></td>
            @endif      
            <td><a href="formeditdatapendudukwarga/{{ $data_penduduk->NIK }}/{{ $data_penduduk->Id_Dusun }}">edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
          </div>
          <!-- <a href="{{url('formadddatapendudukkades')}}" class="tomboladd">Tambah Data</a> -->
      </div>
  </div>
</section>



<section id="buatsurat"  class="section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 text-left">
         <select id="pilihsurat">
                 <option selected="true" disabled="disabled">Surat</option>
                    <option value="surat_ket_domisili">Surat Keterang Domisili</option>
                    <option value="surat_ket_pindah_penduduk">Surat Keterangan Pindah</option>
                    <option value="surat_ket_nikah">Surat Keterangan Nikah</option>
                    <option value="surat_izin_keramaian">Surat Izin Keramaian</option>
                    <option value="surat_kehendak_nikah">Surat Kehendak Nikah</option>
                    <option value="surat_ket_wali">Surat Keterangan Wali</option>
                    <option value="surat_ket_wali_hakim">Surat Keterangan Wali Hakim</option>
                    <option value="surat_persetujuan_mempelai">Surat Persetujuan Mempelai</option>
                    <option value="surat_bio_penduduk">Surat Bio Penduduk</option>
                    <option value="surat_izin_pengangkutan_kayu">Surat izin pengangkutan kayu</option>
                    <option value="surat_izin_pengangkutan_tanah_urug">Surat izin pengangkutan Tanah Urug</option>
                    <option value="surat_ket_beda_identitas_kis">Surat Keterangan Beda Identitas KIS</option>
                    <option value="surat_ket_beda_nama">Surat Keterangan Beda Nama</option>
                    <option value="surat_ket_catatan_kriminal">Surat Keterangan Catatan Kriminal</option>
                    <option value="surat_ket_cerai">Surat Keterangan Cerai</option>
                    <option value="surat_ket_domisili_usaha">Surat Keterangan Domisili Usaha</option>
                    <option value="surat_ket_harga_tanah">Surat Keterangan Harga Tanah</option>
                    <option value="surat_ket_jamkesos">Surat Keterangan Jamkesos</option>
                    <option value="surat_ket_kehilangan">Surat Keterangan Kehilangan</option>
                    <option value="surat_ket_jual_beli">Surat Keterangan Jual Beli</option>
                    <option value="surat_ket_kelakuan_baik">Surat Keterangan Kelakuan Baik</option>
                    <option value="surat_ket_kepemilikan_kendaraan">Surat Kepemilikan Kendaraan</option>
                    <option value="surat_ket_kepemilikan_tanah">Surat Kepemilikan Tanah</option>
                    <option value="surat_ket_kurang_mampu">Surat Keterangan Kurang Mampu</option>
                    <option value="surat_ket_luar_daerah">Surat Keterangan Luar daerah</option>
                    <option value="surat_ket_luar_negeri">Surat Keterangan Luar Negeri</option>
                    <option value="surat_ket_penduduk">Surat Keterangan Luar Penduduk</option>
                    <option value="surat_ket_tidak_memiliki_jamkesos">Surat Keterangan Tidak Memiliki JAMKESOS</option>
                    <option value="surat_ket_usaha">Surat Keterangan Usaha</option>
                    <option value="surat_ket_yatim">Surat Keterangan Yatim</option>
            </select>
          <!-- <input  type="text" name="NIKsurat" placeholder="NIK" id="NIKsurat"> -->
          <select name="NIKsurat" id="NIKsurat">   
                 @foreach ($data_penduduks as $data_penduduk)
                    <option value="{{ $data_penduduk->NIK }}">{{ $data_penduduk->Nama }}</option>
                 @endforeach
          </select><br><br>
        <a href="" id="tombolbuatsurat">Buat Surat</a>
      </div>
    </div>
  </div>
  
</section>        


<section id="tabelberita" class="section-padding tabel7kolom">
      <div class="container-fluid">
         <h1>Data Barang</h1>
        <div class="row">
          <div class="col-md-12">
            <div style="overflow: auto;max-height: 400px;position: relative;  ">
                <table id="tabeldatakadus">
                <thead>
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                   @php
                   $no=1
                   @endphp
                  @foreach($barangdesas as $barangdesa)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $barangdesa->nama }}</td>
                        <td>{{ $barangdesa->harga }}</td>
                        <td>{{ $barangdesa->jumlah }}</td>
                        <td>{{ substr($barangdesa->deskripsi,0,100) }}</td>
                        <td><a href={{ url('formeditbarangdesa/' .  $barangdesa->id ) }}>edit</a></td>
                        <td><a href={{ url('deletebarangdesa/' .  $barangdesa->id ) }}>hapus</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
            <a href="{{url('formaddbarangdesa/'.$jmlbarang)}}" class="tomboladd">Tambah Data Baru</a>
                </div>
              </div>
              <p class="text-center text-danger">{{ session('batas') }}</p>
            </div>
    </section>
      </div>

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="\admincss\vendor/jquery/jquery.min.js"></script>
  <script src="\admincss\vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="\admincss\vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="\admincss\vendor/chart.js/Chart.min.js"></script>
  <script src="\admincss\vendor/datatables/jquery.dataTables.js"></script>
  <script src="\admincss\vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="\admincss\js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="\admincss\js/demo/datatables-demo.js"></script>
  <script src="\admincss\js/demo/chart-area-demo.js"></script>

</body>

</html>
