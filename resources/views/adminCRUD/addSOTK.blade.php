@extends('layouts.layoutform')

@section('content')




<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="{{url('addSOTK')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Nama :<br>
          <input type="text" name="Nama" placeholder="Nama"><br><br>
          Jabatan :<br>
          <input type="text" name="Jabatan" placeholder="Jabatan"><br><br>
          Foto : <br><br>
          <input type="file" name="url_gambar" id="urlgambar">
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



    
       