@extends('layouts.layouthalamanlain')
@section('content')
<br><br><br><br>
 <section id="barang-desa">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{$barangdesas->urlgambar}}" alt="">
            </div>
            <div class="col-md-6">                
                <h2>{{$barangdesas->nama}}</h2>
                <p><strong>Kategori : </strong>{{$barangdesas->kategori}}</p>
                <p><strong>Penjual : </strong>{{$data_penduduks[0]->Nama}}</p>
                <p><strong>No HP : </strong>{{$users->No_HP}}</p>
                <p><strong>Alamat : </strong>{{$users->Alamat}}</p>
                <p><strong>Harga : </strong>Rp.{{$barangdesas->harga}}</p>
                <p><strong>Stok Barang</strong> : {{$barangdesas->jumlah}}</p>
                <p><strong>Deskripsi : </strong>{{$barangdesas->deskripsi}}</p>
            </div>
            </div>
        </div>
    </div>
    </section>

@endsection

