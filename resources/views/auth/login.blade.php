@extends('layouts.master')
<head>
    <link rel="stylesheet" href="{{asset('public/css/index.css')}}" rel="stylesheet">
</head>
@section("content")
  <body>
      <section id="loginregister">
          <div class="form-boxL">
              <div class="form-value">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>LOGIN</h2>
                      <div class="inputbox">
                          <ion-icon name="mail-outline"></ion-icon>
                          <input id="email" name="email" type="mail" class="@error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                          <label for="email">Email</label>
                          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                      </div>
                      <div class="inputbox">
                          <ion-icon name="lock-closed-outline"></ion-icon>
                          <input id="password" name="password"  type="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                          <label for="password">Password</label>
                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                      </div>
                      <div class="forget">
                          <label for=""><input type="checkbox">Remember Me  </label>
                          <label> <a href="#">Forget Password</a></label>
                      </div>
                      <button>Log in</button>
                      <div class="register">
                          <p>Don't have a account <a href="{{asset('register')}}">Register</a></p>
                      </div>
                  </form>
              </div>
          </div>
      </section>
      <script type="module" src="{{ asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')}}"></script>
      <script nomodule src="{{asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js')}}"></script>
  </body>
@endsection

