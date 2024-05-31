@extends('layout/logintemplate')

@section('judul', 'Login')
@section('content')

<body class="hold-transition login-page">
  <div class="login-box"></div>

  <div class="card card-outline">
    <div class="card-body">
      <p class="login-box-msg">Login</p>
      @if(session()->has('pesan'))
      <div class="alert alert-danger">
        {{session()->get('pesan')}}
      </div>
      @endif
      <form action="{{route('auth.verify')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
        @enderror
        
        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
        <a href="{{route('auth.register')}}" class="btn btn-danger btn-block">REGISTER</a>
    </div>
    </form>
  </div>


  @endsection