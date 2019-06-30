@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="{{ url('editbarangdesa/' .  $barangdesas->id ) }}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Nama Barang :<br>
          <input type="text" name="nama_barang" value="{{ $barangdesas->nama }}"><br><br>
          Kategori :<br>
          <select name="kategori">
               <option value="Pertanian">Pertanian</option>
               <option value="Perkebunan">Perkebunan</option>
               <option value="Perikanan">Perikanan</option>
               <option value="Kerajinan">Kerajinan</option>
               <option value="Makanan Olahan">Makanan Olahan</option>
               <option value="Jasa">Jasa</option>
          </select><br><br>
          Harga :<br>
          <input type="text" name="harga" value="{{ $barangdesas->harga }}"><br><br>
          Jumlah :<br>
          <input type="text" name="jumlah" value="{{ $barangdesas->jumlah }}"><br><br>
          Deskripsi :<br>
          <textarea name="deskripsi_barang">{{ $barangdesas->deskripsi }}</textarea><br><br>
          Upload gambar barang : <br><br>
          <input type="file" name="url_gambar" id="url_gambar">
          <br><br>
          <input type="submit" value="Submit">
        </form>
        @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>

        
@endsection



    
        
