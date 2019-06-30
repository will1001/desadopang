@extends('layouts.app')

@section('content')
<div class="container loginregform registerform">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="  Nama">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="NIK" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">NIK</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="NIK" type="text" class="form-control{{ $errors->has('NIK') ? ' is-invalid' : '' }}" name="NIK" value="{{ old('NIK') }}" required placeholder="  NIK">

                                @if ($errors->has('NIK'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NIK') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="  Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="No_HP" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">No HP</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="No_HP" type="text" class="form-control" name="No_HP" required placeholder="  No HP">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Alamat" class="col-xs-4 col-4 col-sm-4 col-md-4 col-form-label text-md-right">Alamat</label>

                            <div class="col-xs-6 col-6 col-sm-6 col-md-6">
                                <input id="Alamat" type="text" class="form-control" name="Alamat" required placeholder="  Alamat">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-xs-6 col-6 col-sm-6 col-md-6 offset-xs-4 offset-4 offset-sm-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="text-center text-danger">{{ session('pesan') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
