@extends('layouts.layouthalamanlain')


@section('content')
<section id="detail_berita" class="section-padding">
      <div class="container">
      <h1 class="text-center">{{$pengumumans->judulpengumuman}}</h1>
      <div class="row">
        <div class="col-md-12">
            <img src="{{ $pengumumans->urlgambar }}" alt="" width="400px" height="250px">
            <h3></h3>
            <p>{{  $pengumumans->deskripsi }}</p><br>
        </div>
      </div>
    </div>
    </section>


  

@endsection
  

