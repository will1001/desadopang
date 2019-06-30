@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="{{ url('editbumdes/' .  $bumdess->id ) }}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Nama Barang :<br>
          <input type="text" name="nama_barang" value="{{ $bumdess->nama }}"><br><br>
          Harga :<br>
          <input type="text" name="harga" value="{{ $bumdess->harga }}"><br><br>
          Jumlah :<br>
          <input type="text" name="jumlah" value="{{ $bumdess->jumlah }}"><br><br>
          Deskripsi :<br>
          <textarea name="deskripsi_barang">{{ $bumdess->deskripsi }}</textarea><br><br>
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



    
        
