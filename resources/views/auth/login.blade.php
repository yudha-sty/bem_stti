@extends('layouts.userLayouts')

@section('content')

    <div class="container d-flex justify-content-center align-items-center mt-login vh-100">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-center align-items-center mb-5 mb-md-0">
                <img class="w-75" src="{{ asset('asset/logo/icon.png') }}" alt="">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-center align-items-center px-5">
                <form  method="POST" action="{{ route('login') }}">
                    @csrf

                    <h3 class="font-weight-bold primary_text_color">
                        Silahkan Sign In Untuk Mengakses Sistem
                    </h3>
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-form" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-form" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-custom btn-block primary_color secondary_text_color">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
