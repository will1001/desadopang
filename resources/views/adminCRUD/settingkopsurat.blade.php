 @extends('layouts.layoutform')

@section('content')

<div class="container-fluid">
  <div class="row text-left">
    <div class="col-md-12">
     <form action="{{url('settingkopsurat')}}" method="post" enctype="multipart/form-data" style="padding-top: 100px;">
          {{ csrf_field() }}
          Nama Kabupaten :<br>
          <input type="text" name="Nama_Kabupaten" placeholder=""><br><br>
          Nama Kecamatan :<br>
          <input type="text" name="Nama_Kecamatan" placeholder=""><br><br>
          Nama Desa :<br>
          <input type="text" name="Nama_Desa" placeholder=""><br><br>
          Alamat Desa :<br>
          <input type="text" name="Alamat_Desa" placeholder=""><br><br>
         
          
          <input type="submit" value="Submit">
        </form>
        @if ($errors->any())
        <h3 class="text-center text-danger">{{ implode('', $errors->all(':message')) }}</h3>
        @endif
    </div>
  </div>
</div>

@endsection