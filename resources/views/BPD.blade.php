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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/lembaga.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
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
                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!--Mainmenu-area/-->



    <section id="lembaga" class="section-padding">
      <div class="container">
      <h1 class="text-center text-uppercase">Badan Permusyawaratan Desa (BPD) Desa Dopang</h1>
       <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h3 class="text-center text-uppercase">kecamatan montong gading kabupaten lombok timur</h3>
            <br><br>
        </div>
      </div>
      </div>
      
      <div class="row" id="visimisi">
        <div class="col-md-12">
          <div class="text-center">
              <img src="images/stokbpd.jpg" alt="grafik organisasi">
          </div>
        

          <div id="konten" class="tabcontent">
            <h3>Hak dan Wewenang BPD</h3>
            <h4 class="text-center">HAK BPD antara lain:</h4>
            <ol>
              <li>Meminta keterangan kepada Pemerintah Desa</li>
              <li>Menyatakan pendapat.</li>
            </ol>
            <h4 class="text-center">HAK Anggota BPD antara lain:</h4>
            <ol>
                <li>Mengajukan rancangan Peraturan Desa</li>

                <li>Mengajukan pertanyaan</li>

                <li>Menyampaikan usul dan pendapat</li>

                <li>Memilih dan dipilih; da</li>

                <li>Memperoleh tunjangan</li>
            </ol>
            <h4 class="text-center">Wewenang BPD antara lain:</h4>
            <ul>
              <li>Membahas rancangan peraturan desa bersama Kepala Desa</li>
              <li>Melaksanakan pengawasan terhadap pelaksanaan Peraturan Desa dan Peraturan Kepala Desa</li>
              <li>Mengusulkan pengangkatan dan pemberhentian Kepala Desa</li>
              <li>Membentuk panitia pemilihan Kepala Desa</li>
              <li>Menggali,menampung, menghimpun, merumuskan dan menyalurkan aspirasi masyarakat; dan</li>
            </ul>
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
    <script src="{{ asset('js/lembaga.js') }}"></script>
</body>

</html>
