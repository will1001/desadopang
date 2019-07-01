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
      <li class="nav-item active">
        <a class="nav-link" href="{{url('formsettingkopsurat')}}">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Setting Kop Surat</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Upload Dokumen</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{url('formuploadapbd/apbd')}}">APBD Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadapbd/rkp')}}">RKP Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadapbd/rpjm')}}">RPJM Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadprofildesa')}}">Profil Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadstatistikdesa')}}">Statistik Desa</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-table"></i>
          <span>Tabel</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          
                    <a class="dropdown-item" href="#tabeldatapendudukkadus">Data penduduk</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#buatsurat">Surat</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#tabelberita">Berita</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#tabelpengumuman">Pengumuman</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#profildesaadmin">SOTK</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#dataakundesa">Data akun Login</a>
        </div>
      </li>
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
          <section id="tabeldatapendudukkadus"  class="section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h1>Tabel data Penduduk Desa Dopang</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-12 col-sm-6 col-md-6">
            <select id="pilihankadus">
                 <option selected="true" disabled="disabled">Dusun</option>
                 @foreach ($kode_area_dusuns as $kode_area_dusun)
                    <option value="{{ $kode_area_dusun->id_dusun }}">{{ $kode_area_dusun->Nama_Dusun }}</option>
                 @endforeach
            </select>
          </div>

          <div class="col-xs-12 col-12 col-sm-6 col-md-6 search-posisi">
            <button id="tombol_search">Search</button>  
            <div class="search">
            <input type="text"  id="search" name="search" placeholder=". . ." ></input>
            </div>
            <select id="filter">
                 <option selected="true" disabled="disabled">Cari Berdasarkan</option>
                  <option value="Nama">Nama</option>
                  <option value="NIK">NIK</option>
                  <option value="Pendidikan">Pendidikan</option>
                  <option value="Status_Perkawinan">status Perkawinan</option>
                  <option value="Golongan_Darah">Golongan Darah</option>
            </select>
            
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
        <tr>
                  <th>No</th>
                  <th>Alamat</th>
                  <th>RW</th>
                  <th>RT</th>
                  <th id="nama_tombol">Nama</th>
                  <th>Nomor KK</th>
                  <th>Nomor NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Usia</th>
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
                  <th>hapus</th> 
        </tr>
      </thead>
       <tbody id="tbodytabel">
      </tbody>
    </table>
          </div>
          <a href="#" class="previous">&laquo; Previous</a>
          <a href="#" class="next">Next &raquo;</a>
          <a href="{{url('formadddatapendudukkades')}}" class="tomboladd">Tambah Data</a>
        </div>
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
          <input  type="text" name="NIKsurat" placeholder="NIK" id="NIKsurat">
        <a href="" id="tombolbuatsurat">Buat Surat</a>
      </div>
    </div>
  </div>
  
</section>

<section id="tabelberita" class="section-padding  gray-bg">
      <div class="container-fluid">
         <h1>Tabel data Berita Desa</h1>
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
                    <th>Judul Berita</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                  @foreach($beritas as $berita)
                    <tr>
                      <td>{{ $berita->judulberita }}</td>
                      <td>{{ substr($berita->deskripsi,0,100) }}</td>
                      <td><a href={{ url('formeditberita/' .  $berita->id ) }}>edit</a></td>
                      <td><a href={{ url('deleteberita/' .  $berita->id ) }}>hapus</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
              <a href="{{url('formaddberita')}}" class="tomboladd">Buat Berita Baru</a>
              
                </div>
              </div>
            </div>
    </section>




    








      <section id="tabelpengumuman">
      <div class="container-fluid">
        <h1>Tabel data Pengumuman Desa</h1>
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
                    <th>Judul Pengumuman</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                  @foreach($pengumumandesas as $pengumumandesa)
                    <tr>
                      <td>{{ $pengumumandesa->judulpengumuman }}</td>
                      <td>{{ substr($pengumumandesa->deskripsi,0,100) }}</td>
                      <td><a href={{ url('formeditpengumuman/' .  $pengumumandesa->id ) }}>edit</a></td>
                      <td><a href={{ url('deletepengumuman/' .  $pengumumandesa->id ) }}>hapus</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
                <a href="{{url('formaddpengumuman')}}" class="tomboladd">Buat Pengumuman Baru</a>                      
                
          </div>
        </div>
      </div>
    </section>




    <section id="profildesaadmin" class="section-padding">
      <div class="container">
         <h2>SOTK</h2>
         @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
        {{-- <div class="row">
           <div class="col-md-12">
           
            <form action="{{ url('editdeskripsiprofildesa') }}" method="post" enctype="multipart/form-data" style="padding-top: 1px;">
                {{ csrf_field() }}
                <textarea  rows="10" name="deskripsiprofildesa">{{ $SOTKs[0]->desripsiprofildesa }}</textarea>
                <input class="button white" type="submit" value="Edit" id="edutbuttondeskripsi">
              </form>

            </div>
          </div> --}}
          <div class="row text-center">


            @foreach($SOTKs as $SOTK)
           <div class="col-12 col-xs-12 col-sm-12 col-md-3">
            <img src="{{ $SOTK->urlgambar }}" alt="">
            <h1 class="text-center" >{{ $SOTK->Nama }}</h1>
            <h3 class="text-center">{{ $SOTK->Jabatan }}</h3>
            <a href="{{url('formeditSOTK/'.$SOTK->id)}}">Ganti</a>
            </div>
            @endforeach

       

          </div>
        </div>
    </section>


    <section id="dataakundesa" class="section-padding tabel5kolom  gray-bg">
      <div class="container-fluid">
         <h1>Tabel Data Akun Login Web Desa</h1>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th> 
                    <th>Aktifasi</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email}}</td>
                      <td>{{ $user->status}}</td>
                      <td><a href={{ url('aktifasiakun/' .  $user->id ) }}>aktifasi</a></td>
                      <td><a href={{ url('deleteakun/' .  $user->id ) }}>hapus</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
              
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
