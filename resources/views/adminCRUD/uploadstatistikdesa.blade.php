@extends('layouts.layoutform')

@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action={{ url('uploadstatistikdesa') }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Upload file Statistik Desa : <br><br>
          <input type="file" name="url_gambar[]" multiple>
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



    
        
