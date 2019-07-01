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
            <h1 class="text-center">Data Kependudukan Anda</h1><br><br>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6">


        <p><strong>Nama : </strong>{{$data_penduduks[0]->Nama}}</p>
        <p><strong>Alamat : </strong>{{$data_penduduks[0]->Alamat}}</p>
        @if ($kode_area_dusuns->count()>0)
           <p><strong>Dusun : </strong>{{$kode_area_dusuns[0]->Nama_Dusun}}</p>
        @else
          <p><strong>Dusun : </strong> - </p>
        @endIf
        <p><strong>RW : </strong>{{$data_penduduks[0]->RW}}</p>
        <p><strong>RT : </strong>{{$data_penduduks[0]->RT}}</p>
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
  </div>
</section>        


<section id="tabelberita" class="section-padding tabel7kolom">
      <div class="container-fluid">
         <h1>Tabel data Barang</h1>
        <div class="row">
          <div class="col-md-12">
            <div style="overflow: auto;max-height: 400px;position: relative;  ">
                <table id="tabeldatakadus">
                <thead>
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <tr>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
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
