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
         <h1 class="text-center">Admin Dusun {{$kode_area_dusuns[0]->Nama_Dusun}}</h1>
          <section id="tabeldatapendudukkadus"  class="section-padding">
      <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-6 col-md-6">
            <div class="searchkadus text-left">
                <input type="text"  id="searchkadus" name="searchkadus" placeholder="Masukan NIK atau Nama" ></input>
            </div>
            <button id="tombol_searchkadus" value="{{$kode_area_dusuns[0]->id_dusun}}">Search</button>  
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h1 style="margin-bottom: 35px;">Tabel Data Penduduk Dusun {{$kode_area_dusuns[0]->Nama_Dusun}}</h1>

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
        <tr>
                  <th>No</th>
                  <th>Alamat</th>
                  <th>RW</th>
                  <th>RT</th>
                  <th>Nama</th>
                  <th>Nomor KK</th>
                  <th>Nomor NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Agama</th>
                  <th>Pendidikan</th>
                  <th>Jenis Pekerjaan</th> 
                  <th>Status Perkawinan</th> 
                  <th>Status Hubungan Dalam Keluarga</th> 
                  <th>Kewarganegaraan</th> 
                  <th>Nama Ayah</th> 
                  <th>Nama Ibu</th> 
                  <th>Golongan Darah</th> 
                  <th>Akta Lahir</th> 
                  <th>Nomor Dokumen Paspor</th>
                  <th>Tanggal Akhir Paspor</th>  
                  <th>Nomor Dokumen KITAS</th>             
                  <th>NIK Ayah</th> 
                  <th>NIK Ibu</th> 
                  <th>No Akta Perkawinan</th> 
                  <th>Tanggal Perkawinan</th> 
                  <th>No Akta Perceraian</th> 
                  <th>Tanggal Perceraian</th> 
                  <th>Cacat</th> 
                  <th>Cara KB</th> 
                  <th>Hamil</th> 
                  <th>Status kependudukan</th> 
                  <th>Keterangan</th> 
                  <th>edit</th>  
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
            <td>{{ $data_penduduk->Jenis_Kelamin }}</td>
            <td>{{ $data_penduduk->Tempat_Lahir }}</td>
            <td>{{ $data_penduduk->Tanggal_Lahir }}</td>
            <td>{{ $data_penduduk->Agama }}</td>
            <td>{{ $data_penduduk->Pendidikan }}</td>
            <td>{{ $data_penduduk->Jenis_Pekerjaan }}</td>
            <td>{{ $data_penduduk->Status_Perkawinan }}</td>
            <td>{{ $data_penduduk->Status_Hubungan_Dalam_Keluarga }}</td>
            <td>{{ $data_penduduk->Kewarganegaraan }}</td>
            <td>{{ $data_penduduk->Nama_Ayah }}</td>
            <td>{{ $data_penduduk->Nama_Ibu }}</td>
            <td>{{ $data_penduduk->Golongan_Darah }}</td>
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
            <td><a href="formeditdatapendudukkadus/{{ $data_penduduk->NIK }}">edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
          </div>
        </div>
        </div>
      </div>
    </section>



    <section id="tabeldatapendudukkadus2"  class="section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            
            <input type="text" name="NIK" placeholder="NIK" id="NIK"><br><br>
            

            <a href="" class="tomboledit" id="edittombol">Penduduk keluar</a>
            <a href="{{url('formadddatapendudukkadus')}}" class="tomboladd">Penduduk Masuk</a>
            
            

          </div>
        </div>
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
