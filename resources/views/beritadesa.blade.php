@extends('layouts.layouthalamanlain')

@section('content')

<section id="berita-desa" class="section-padding">
      <div class="container">
      <h1 class="text-center">Berita Desa Dopang</h1>
      @foreach($beritas as $berita)
      <div class="row">
        <div class="col-md-12">
            <img src="{{ $berita->urlgambar }}" alt="" width="400px" height="250px">
            <h3>{{ $berita->judulberita }}</h3>
            <p>{{ substr($berita->deskripsi,0,510) }} . . . </p><br>
            <a class="button white " href="{{ url('detailberitadesa/' .  $berita->judulberita ) }}">Selengkapnya>></a>
        </div>

      </div>

      @endforeach



      {{ $beritas->links() }}



    </div>
    </section>


@endsection






  
