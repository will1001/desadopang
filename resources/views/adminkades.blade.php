<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Desa Perian</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">
    <link rel="shortcut icon" type="image/ico" href="{{asset('images/favicon.ico')}}" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsiveadmin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/table.css')}}">
     <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!--[if lt IE 9]>
        <script src="{{asset('')}}//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="{{asset('')}}//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">



    <!--Mainmenu-area-->
    <div class="mainmenu-area" data-spy="affix" data-offset-top="100">
        <div class="container">
            <!--Logo-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle butto" data-toggle="collapse" data-target="#primary-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{url('/')}}" class="navbar-brand logo">
                  <img id="logo" src="images/kabupaten-lombok-timur-ntb (1).png" alt="">
                    <h5><strong>Website Resmi Pemerintah</strong></h5>
                    <h2>Desa Perian</h2>
                </a>
            </div>
            <!--Logo/-->
    <nav class="collapse navbar-collapse" id="primary-menu">
      <ul class="nav navbar-nav navbar-right">
        @guest
              <li>
                  <a href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
        @else

              <li class="nav-item dropdown">
                <a href="{{url('formsettingkopsurat')}}" >Setting Kop Surat</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    upload dokumen <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('formuploadapbd/apbd')}}">APBD Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadapbd/rkp')}}">RKP Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadapbd/rpjm')}}">RPJM Desa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('formuploadprofildesa')}}">Profil Desa</a>
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="{{url('formuploadstatistikdesa')}}">Statistik Desa</a> --}}
                  </div>
              </li>
              <li class="nav-item dropdown">
                   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->email }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
       </ul>
      </nav>
    </div>
    </div>
    <!--Mainmenu-area/-->
            



<section id="tabeldatapendudukkadus"  class="section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h1>Tabel data Penduduk Desa Perian</h1>
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



 

   <footer class="footer-area relative sky-bg" id="contact-page">
        <div class="absolute footer-bg"></div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <address class="side-icon-boxes">
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="{{asset('images/location-arrow.png')}}" alt="">
                                </div>
                                <p><strong>Alamat: </strong>Jl. Jurusan Montong Gading - Perian, Km 4, Desa Perian.Kode Pos 83664</p>
                            </div>
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="{{asset('images/phone-arrow.png')}}" alt="">
                                </div>
                                <p><strong>Telpon: </strong>
                                    08123456789
                                </p>
                            </div>
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="{{asset('images/mail-arrow.png')}}" alt="">
                                </div>
                                <p><strong>E-mail: </strong>
                                    <a href="mailto:youremail@example.com">kantor@desaperian.id</a>
                                    
                                </p>
                            </div>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 pull-right">
                        <ul class="social-menu text-right x-left">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-google"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>&copy;Copyright 2018.made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://winchy.tech">winchy.tech</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>





    <!--Vendor-JS-->
    <script src="{{asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <!--Plugin-JS-->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/contact-form.js')}}"></script>
    <script src="{{asset('js/jquery.parallax-1.1.3.js')}}"></script>
    <script src="{{asset('js/scrollUp.min.js')}}"></script>
    <script src="{{asset('js/magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!--Main-active-JS-->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>