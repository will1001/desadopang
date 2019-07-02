<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsive.css') }}">
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Open+Sans?selection.family=Open+Sans">

    <title>Desa Dopang</title>
  </head>
  <body>



<div id="logo">
  <div class="container">
    <a class="navbar-brand" href="#">
    <img src="/images/Kabupaten_Lombok_Tengah.png" width="50" height="50" class="d-inline-block align-top" alt="">
    <div id="spacetextlogo">
    <span id="logotext" class="text-secondary">DESA DOPANG</span>
    <span id="logotext2" class="text-secondary">PORTAL RESMI PEMERINTAH DESA</span>
    </div>
  </a>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="container">
        <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
        <div class="garisbawah active"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indexberita') }}">Berita</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indextransparansi') }}">Transparansi</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indexproduk') }}">BUMDES</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item dropdown ml-auto">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MASUK <br>
          <span class="bungkusarrow">
            <i class="arrowdown"></i><br><i class="arrowdown arrowke2"></i>
          </span>
        </a>
        <div class="dropdown-menu speech-bubble" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/daftarpage')}}">DAFTAR</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{url('/loginpage')}}">LOGIN</a>
        </div>
      </li>
    </ul>
    </div>
  </div>
</nav>


<section id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 id="slogan1">SELAMAT DATANG DI DESA</h1>
                <h1 id="slogan2">DOPANG</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ url('/profildesadopang') }}">PROFIL DESA</a>
                <div id="pembatas"></div>
                <div class="btn-group dropright">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">INFO TERBARU</a>
                <div class="dropdown-menu speech-bubble2" aria-labelledby="navbarDropdown">
                  <h3>Berita Terbaru</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur quisquam tempore quod, amet tenetur id quaerat natus praesentium vero aliquid, soluta earum accusantium similique voluptates cum? Eos modi sunt, quos.</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div id="foothome">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="/images/alamat.png" alt="">
                <h4>Alamat</h4>
                <p>Jl. Makam Batu Riti , Desa, Dopang, Kecamatan Gunug Sari ,KAbupaten Lombok Barat ,Nusa Tenggara Barat.83351</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/telepon.png" alt="">
                <h4>Telepon</h4>
                <p>xxxxxxxxx</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/email.png" alt="">
                <h4>Email</h4>
                <p>desadopang@gmail.com</p>
            </div>    
        </div>    
    </div>
</section>

<section id="profildesa">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-12 text-center">
        <img src="/images/clement-guillou-413001-unsplash.jpg" alt="">
      </div>
      <div class="col-md-6 col-sm-12">
        <h1>SELAYANG PANDANG</h1>
        <p>Desa Dopang adalah salah satu desa yang terletak di kecamatan Gunung Sari, kabupaten Lombok Barat. Sebagian besar penduduk kami bersuku sasak, dengan hasil tani penduduk berupa kopi, kelapa, kakao, jagung, dll. <br><br> Semakin dekat dengan masyarakat adalah prioritas kami selaku pemerintah desa agar dapat memberikan pelayanan yang semaksimal mungkin.</p>
      </div>
    </div>
  </div>
</section>


<footer>
  <div class="footer-bottom">
     <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>&copy;Copyright 2019.made with <i class="far fa-heart"></i> by <a href="https://winchy.tech">winchy.tech
          </div>
        </div>
     </div>
 </div>
</footer>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>