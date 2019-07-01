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
    <title>Desa Dopang</title>
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
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!--[if lt IE 9]>
        <script src="{{asset('')}}//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="{{asset('')}}//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">
@php
  $no=1
@endphp


     <!--Mainmenu-area-->
    <div class="mainmenu-area" data-spy="affix" data-offset-top="100">
        <div class="container">
            <!--Logo-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{url('/')}}" class="navbar-brand logo">
                  <img id="logo" src="images/kabupaten-lombok-timur-ntb (1).png" alt="">
                    <h5><strong>Website Resmi Pemerintah</strong></h5>
                    <h2>Desa Dopang</h2>
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
                    <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
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
                              </div>
                            </li>
                            <li class="nav-item dropdown navigation">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Tabel Data <span class="caret"></span>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdowntabel">
                                <a class="dropdown-item" href="#tabelberita">Tabel Berita</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabelpengumuman">Tabel Pengumuman</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabeljmlpend">Tabel Jumlah Penduduk</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabelstatpendidikanpend">Tabel Statistik Penduduk Menurut Pendidikan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabelstatpekerjaanpend">Tabel Statistik Penduduk Menurut Pekerjaan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabelstatetnispend">Tabel Statistik Penduduk Menurut etnis/suku</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#tabelstatagamapend">Tabel Statistik Penduduk Menurut Agama</a>
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
   




    <section id="tabelberita" class="section-padding">
      <div class="container-fluid">
         <h1>Tabel data Berita Desa</h1>
        <div class="row">
          <div class="col-md-12">
            <div class="limiter">
             
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">Judul Berita</th>
                                        <th class="cell100 column2">Deskripsi</th>
                                        <th class="cell100 column4">edit</th>
                                        <th class="cell100 column5">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                              @foreach($beritas as $berita)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $berita->judulberita }}</td>
                                 <td class="cell100 column2">{{ substr($berita->deskripsi,0,50) }}</td>
                                 <td class="cell100 column3"><a href={{ url('formeditberita/' .  $berita->id ) }}>edit</a></td>
                                 <td class="cell100 column4"><a href={{ url('deleteberita/' .  $berita->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                           </div>

                        </div>
                        <a href="{{url('formaddberita')}}" class="tomboladd">Buat Berita Baru</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}
                       
                </div>
              </div>
            </div>
    </section>




      <section id="tabelpengumuman">
      <div class="contaitabelluid">
        <h1>Tabel data Pengumuman Desa</h1>
        <div class="row">
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">Judul Pengumuman</th>
                                        <th class="cell100 column2">Deskripsi</th>
                                        <th class="cell100 column4">edit</th>
                                        <th class="cell100 column5">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                              @foreach($pengumumandesas as $pengumumandesa)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $pengumumandesa->judulpengumuman }}</td>
                                 <td class="cell100 column5">{{ substr($pengumumandesa->deskripsi,0,50) }}</td>
                                 <td class="cell100 column6"><a href={{ url('formeditpengumuman/' .  $pengumumandesa->id ) }}>edit</a></td>
                                 <td class="cell100 column7"><a href={{ url('deletepengumuman/' .  $pengumumandesa->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                            
                        </div>
                        <a href="{{url('formaddpengumuman')}}" class="tomboladd">Buat Pengumuman Baru</a>                      
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}
          </div>
        </div>
      </div>
    </section>

         


      


      <section id="tabeljmlpend"  class="tabel5kolom section-padding">
      <div class="container-fluid">
        <h1>Tabel data Jumlah Penduduk Desa Dopang</h1>
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">No</th>
                                        <th class="cell100 column2">wilayah</th>
                                        <th class="cell100 column3">Jumlah</th>
                                        <th class="cell100 column4">Edit</th>
                                        <th class="cell100 column5">Hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                              @foreach($jmlpends as $jmlpend)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $no++ }}</td>
                                 <td class="cell100 column2">{{ $jmlpend->wilayah }}</td>
                                 <td class="cell100 column3">{{ $jmlpend->jumlah }}</td>
                                 <td class="cell100 column4"><a href={{ url('formeditjmlpend/' .  $jmlpend->id ) }}>edit</a></td>
                                 <td class="cell100 column5"><a href={{ url('deletejmlpend/' .  $jmlpend->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                        </div>
                        <a href="{{url('formaddjmlpend')}}" class="tomboladd">Tambah Data</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}


        </div>
        </div>
        </div>
    </section>




      <section id="tabelstatpendidikanpend" class="tabel7kolom section-padding section-padding">
      <div class="container-fluid">
        <h1>Tabel Statistik Penduduk Menurut Pendidikan</h1>
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">No</th>
                                        <th class="cell100 column2">Tingkat Pendidikan</th>
                                        <th class="cell100 column3">Pria</th>
                                        <th class="cell100 column4">Wanita</th>
                                        <th class="cell100 column5">Jumlah</th>
                                        <th class="cell100 column6">edit</th>
                                        <th class="cell100 column7">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                                 @php
                                  $no=1
                                @endphp
                              @foreach($pendidikans as $pendidikan)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $no++ }}</td>
                                 <td class="cell100 column2">{{ $pendidikan->pendidikan }}</td>
                                 <td class="cell100 column3">{{ $pendidikan->pria }}</td>
                                 <td class="cell100 column4">{{ $pendidikan->wanita }}</td>
                                 <td class="cell100 column5">{{ $pendidikan->jumlah }}</td>
                                 <td class="cell100 column6"><a href={{ url('formeditstatpendidikanpend/' .  $pendidikan->id ) }}>edit</a></td>
                                 <td class="cell100 column7"><a href={{ url('deletestatpendidikanpend/' .  $pendidikan->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                        </div>
                        <a href="{{url('formaddstatpendidikanpend')}}" class="tomboladd">Tambah Data</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}


        </div>
        </div>
      </div>
    </section>




      <section id="tabelstatpekerjaanpend" class="tabel7kolom section-padding">
      <div class="container-fluid">
        <h1>Tabel Statistik Penduduk Menurut Pekerjaan</h1>
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">No</th>
                                        <th class="cell100 column2">Pekerjaan</th>
                                        <th class="cell100 column3">Pria</th>
                                        <th class="cell100 column4">Wanita</th>
                                        <th class="cell100 column5">Jumlah</th>
                                        <th class="cell100 column6">edit</th>
                                        <th class="cell100 column7">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                                @php
                                  $no=1
                                @endphp
                              @foreach($pekerjaans as $pekerjaan)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $no++ }}</td>
                                 <td class="cell100 column2">{{ $pekerjaan->pekerjaan }}</td>
                                 <td class="cell100 column3">{{ $pekerjaan->pria }}</td>
                                 <td class="cell100 column4">{{ $pekerjaan->wanita }}</td>
                                 <td class="cell100 column5">{{ $pekerjaan->jumlah }}</td>
                                 <td class="cell100 column6"><a href={{ url('formeditstatpekerjaanpend/' .  $pekerjaan->id ) }}>edit</a></td>
                                 <td class="cell100 column7"><a href={{ url('deletestatpekerjaanpend/' .  $pekerjaan->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                        </div>
                        <a href="{{url('formaddstatpekerjaanpend')}}" class="tomboladd">Tambah Data</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}


        </div>
        </div>
        </div>
    </section>



      <section id="tabelstatetnispend" class="tabel7kolom section-padding">
      <div class="container-fluid">
        <h1>Tabel Statistik Penduduk Menurut etnis/suku</h1>
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">No</th>
                                        <th class="cell100 column2">Etnis/Suku</th>
                                        <th class="cell100 column2">Pria</th>
                                        <th class="cell100 column2">Wanita</th>
                                        <th class="cell100 column5">Jumlah</th>
                                        <th class="cell100 column6">edit</th>
                                        <th class="cell100 column7">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                               @php
                                  $no=1
                                @endphp
                              @foreach($etniss as $etnis)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $no++ }}</td>
                                 <td class="cell100 column2">{{ $etnis->etnis }}</td>
                                 <td class="cell100 column3">{{ $etnis->pria }}</td>
                                 <td class="cell100 column4">{{ $etnis->wanita }}</td>
                                 <td class="cell100 column5">{{ $etnis->jumlah }}</td>
                                 <td class="cell100 column6"><a href={{ url('formeditstatetnispend/' .  $etnis->id ) }}>edit</a></td>
                                 <td class="cell100 column7"><a href={{ url('deletestatetnispend/' .  $etnis->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                        </div>
                        <a href="{{url('formaddstatetnispend')}}" class="tomboladd">Tambah Data</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}


        </div>
        </div>
        </div>
    </section>



      <section id="tabelstatagamapend" class="tabel7kolom section-padding">
      <div class="container-fluid">
        <h1>Tabel Statistik Penduduk Menurut Agama</h1>
          <div class="col-md-12">
          <div class="limiter">
                          <div class="container-table100">
                            <div class="wrap-table100">
                              <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                  <table>
                                    <thead>
                                      <tr class="row100 head">
                                        <th class="cell100 column1">No</th>
                                        <th class="cell100 column2">Etnis/Suku</th>
                                        <th class="cell100 column2">Pria</th>
                                        <th class="cell100 column2">Wanita</th>
                                        <th class="cell100 column5">Jumlah</th>
                                        <th class="cell100 column6">edit</th>
                                        <th class="cell100 column7">hapus</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                           <div class="table100-body js-pscroll">
                           <table>
                             <tbody>
                               @php
                                  $no=1
                                @endphp
                              @foreach($agamas as $agama)
                               <tr class="row100 body">
                                 <td class="cell100 column1">{{ $no++ }}</td>
                                 <td class="cell100 column2">{{ $agama->agama }}</td>
                                 <td class="cell100 column3">{{ $agama->pria }}</td>
                                 <td class="cell100 column4">{{ $agama->wanita }}</td>
                                 <td class="cell100 column5">{{ $agama->jumlah }}</td>
                                 <td class="cell100 column6"><a href={{ url('formeditstatagamapend/' .  $agama->id ) }}>edit</a></td>
                                 <td class="cell100 column7"><a href={{ url('deletestatagamapend/' .  $agama->id ) }}>hapus</a></td>
                               </tr>
                              @endforeach
                             </tbody>
                           </table>
                            </div>
                        </div>
                        <a href="{{url('formaddstatagamapend')}}" class="tomboladd">Tambah Data</a>
                      </div>
                    </div>
                  </div>

                           
                           

                           {{ $beritas->links() }}


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
                                <p><strong>Alamat: </strong>Jl. Jurusan Montong Gading - Dopang, Km 4, Desa Dopang.Kode Pos 83664</p>
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
                                    <a href="mailto:youremail@example.com">kantor@desaDopang.id</a>
                                    
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
</body>

</html>