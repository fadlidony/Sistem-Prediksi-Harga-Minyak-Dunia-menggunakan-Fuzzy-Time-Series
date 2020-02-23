@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css"/>
@endsection

@section('content')
  <div class="be-wrapper be-login">
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="splash-container">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading"><img src="{{asset('img/logo-xx.png')}}" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Prediksi Harga Minyak Dunia Menggunakan Fuzzy Time Series.</span></div>
            <div class="panel-body">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input id="email" type="email" name="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}" class="form-control" required>
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group row login-tools">
                  <div class="col-xs-6 login-remember">
                    <div class="be-checkbox">
                      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label for="remember">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-xs-6 login-forgot-password"><a href="{{ route('password.request') }}">Forgot Password?</a></div>
                </div>
                <div class="form-group login-submit">
                  <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Login</button>
                </div>
              </form>
            </div>
          </div>
          {{-- <div class="splash-footer"><span>Don't have an account? <a href="#">Sign Up</a></span></div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection





{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
