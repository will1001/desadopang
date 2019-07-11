<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style2.css') }}">
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Open+Sans?selection.family=Open+Sans">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsiveindexberita.css') }}">
    <link rel="stylesheet" href="{{asset('css/table.css')}}">
    <link rel="stylesheet" href="{{asset('css/statistik.css')}}">



    <title>Desa Dopang</title>
    <style>
        body{
        background-image: url("/images/roman-kraft-260082-unsplash.jpg");
        } 
    </style>
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
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/beritadesa') }}">Berita</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indextransparansi') }}">Transparansi</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/statistik') }}">Statistik Desa</a>
        <div class="garisbawah active"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indexproduk') }}">BUMDES</a>
        <div class="garisbawah"></div>
      </li>
      
    </ul>
    </div>
  </div>
</nav>



    <section id="statistik" style="margin-top: 91px;">
      <div class="container" id="app">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">Data statistik Desa</h1>
              <div :is="currentchart" class="wow fadeIn"  @clicked="gantichart" keep-alive></div>
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




    <!-- <script src="{{ asset('/js/date.js') }}" type="text/javascript" charset="utf-8" async defer></script> -->
    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/wow.min.js') }}" type="text/javascript"></script>
</body>

</html>