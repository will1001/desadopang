@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action={{ url('editpengumuman/' .  $pengumumans->id ) }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Judul Pengumuman:<br>
          <input type="text" name="judul_pengumuman" value="{{ $pengumumans->judulpengumuman }}"><br><br>
          Isi Pengumuman:<br>
          <textarea rows="30" cols="200" name="isi_pengumuman">{{ $pengumumans->deskripsi }}</textarea><br><br>
          Gambar : <br><br>
          <input type="file" name="url_gambar" id="url_gambar" value={{ $pengumumans->urlgambar }}>
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



    
        
