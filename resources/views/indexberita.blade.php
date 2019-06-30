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

    <title>Jurang Jaler</title>
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
    <span id="logotext" class="text-secondary">DESA JURANG JALER</span>
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
        <a class="nav-link" href="{{ url('/indexberita') }}">Berita</a>
        <div class="garisbawah active"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indextransparansi') }}">Transparansi</a>
        <div class="garisbawah"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/indexproduk') }}">produk</a>
        <div class="garisbawah"></div>
      </li>
      
    </ul>
    </div>
  </div>
</nav>


<section id="home">
    <div class="container-fluid">
        <div class="row" id="app">
            <div class="col-md-6 text-center">
                
            </div>
            <div class="col-md-6 text-center">
                <div class="row slideshowgambar">
                  <div class="col-md-4">
                    <img src="/images/bg.jpg" alt="" :class="{ active : active_el == 0 }">
                  </div>
                  <div class="col-md-4">
                    <img src="/images/bg.jpg" alt="" :class="{ active : active_el == 1 }">
                  </div>
                  <div class="col-md-4">
                    <img src="/images/bg.jpg" alt="" :class="{ active : active_el == 2 }">
                  </div>
                </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="arrow-left text-center"  @click="activateleft();"></div>
                  <div class="arrow-right text-center" @click="activateright();"></div>
                  <br><br><br>
                  <h3>Pemberian Bantuan Kepala Desa</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam perferendis illum veniam explicabo vitae modi quasi rerum culpa accusamus magni corporis libero dolor optio iure, delectus laudantium. Nesciunt architecto, impedit?</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
    <script>
          var vo = new Vue({
            el : '#app',
            data: {
              active_el : 1,
              animasi : 1,
            },
            methods:{
              activateleft:function(){
                  if(this.active_el>0){
                    this.active_el--;
                  }else{
                    this.active_el=2;
                  }
              },
              activateright:function(){
                  if(this.active_el<2){
                    this.active_el++;
                  }else{
                    this.active_el=0;
                  }
              }
            }
          });
    </script> 
  </body>
</html>