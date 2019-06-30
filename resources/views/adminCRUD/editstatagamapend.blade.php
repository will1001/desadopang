@extends('layouts.layoutform')

@section('content')



<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action={{ url('editstatagamapend/' .  $agamas->id ) }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Agama :<br>
          <input type="text" name="agama" value="{{$agamas->agama}}"><br><br>
          Pria :<br>
          <input type="text" name="pria" value="{{$agamas->pria}}"><br><br>
          Wanita :<br>
          <input type="text" name="wanita" value="{{$agamas->wanita}}"><br><br>
          <input type="submit" value="Submit">
        </form>
@if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>

@endsection



    
        
