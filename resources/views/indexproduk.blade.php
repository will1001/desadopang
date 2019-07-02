@extends('layouts.layouthalamanlain')

@section('content')




    <section id="barang-desa">
      <div class="container">
      <h1 class="text-center">BUMDES Desa Dopang</h1>
      <div class="row">
          <div class="col-xs-6 col-6 col-sm-6 col-md-6">
              <form action="{{url('caribarangdesa')}}" method="post" accept-charset="utf-8">
                  {{ csrf_field() }}
                  <input type="text"  id="search" name="search" placeholder="Masukan Nama Barang" ></input>
                  <input type="submit" value="Search" id="tombol_search_barang">
              </form>
          </div>
      </div>
        <div class="row">
            @foreach($barangdesas as $barangdesa)
            <div class="col-xs-6 col-6 col-sm-6 col-md-2" id="kotakbarang">
                <div class="card">
                  <img class="card-img-top" src="{{$barangdesa->urlgambar}}" alt="Card image cap">
                  <div class="card-body text-center">
                    <h5 class="card-title">{{ substr($barangdesa->nama,0,23) }}</h5>
                    <p class="card-text">{{$barangdesa->harga}}</p>
                    <a href="{{ url('detailbarangdesa/' .  $barangdesa->id ) }}" class="btn btn-primary">Lihat</a>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </section>



@endsection