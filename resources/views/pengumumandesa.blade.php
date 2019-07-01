
@extends('layouts.layouthalamanlain')

@section('content')

<section id="tentang-desa">
      <div class="container">
      <h1 class="text-center">Pengumuman Desa Dopang</h1>
      @foreach($pengumumans as $pengumuman)
      <div class="row">
        <div class="col-md-12">
            <img src="{{ $pengumuman->urlgambar }}" alt="" width="400px" height="250px">
            <h3>{{ $pengumuman->judulpengumuman }}</h3>
            <p>{{ substr($pengumuman->deskripsi,0,150) }}</p><br>
            <a href="{{ url('detailpengumuman/' .  $pengumuman->judulpengumuman ) }}">Selengkapnya>></a>
        </div>

      </div>

      @endforeach



      {{ $pengumumans->links() }}



    </div>
    </section>


  


  
@endsection