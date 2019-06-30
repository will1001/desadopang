 @extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="{{url('addjmlpend')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Wilayah :<br>
          <input type="text" name="wilayah" value="wilayah"><br><br>
          Jumlah :<br>
          <input type="text" name="jumlah" value="100"><br><br>
          <input type="submit" value="Submit">
        </form>
        @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>

@endsection