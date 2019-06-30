@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action={{ url('editberita/' .  $beritas->id ) }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Judul Berita:<br>
          <input type="text" name="judul_berita" value="{{ $beritas->judulberita }}"><br><br>
          Isi Berita:<br>
          <textarea  rows="30" cols="200" name="isi_berita">{{ $beritas->deskripsi }}</textarea><br><br>
          Gambar : <br><br>
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



    
        
