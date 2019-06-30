@extends('layouts.layoutform')

@section('content')




<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action={{ url('editjmlpend/' .  $jmlpends->id ) }} method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Wilayah :<br>
          <input type="text" name="wilayah" value="{{$jmlpends->wilayah}}"><br><br>
          Jumlah :<br>
          <input type="text" name="jumlah" value="{{$jmlpends->jumlah}}"><br><br>
          <input type="submit" value="Submit">
        </form>

  @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>


@endsection



    
        
  