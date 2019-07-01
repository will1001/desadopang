@extends('layouts.layouttransparansi')

@section('content')


    <section id="detailprofildesa" class="section-padding text-center">
      <div class="container">
      
      <div class="row" style="padding-top: 35px;">
        <div class="col-md-12">

            @foreach($profil_desas as $profil_desa)

            <img src="{{ $profil_desa->urlgambar}}" alt="" style="width: 100%">
            <br>
            

            @endforeach
             
    
           
        </div>

      </div>
    </div>
    </section>
@endsection