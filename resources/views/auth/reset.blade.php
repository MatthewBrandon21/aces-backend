<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ACES - {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/components.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-94034622-3');
    </script>
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('') }}assets/img/Logo Aces Horizontal.png" alt="logo" width="250">
            </div>
            <div class="card card-primary">
              <div class="card-body">
                <form action="{{ route('reset.password') }}" method="post" autocomplete="off">
                  @if (Session::get('fail'))
                    <div class="alert alert-danger">
                      {{ Session::get('fail') }}
                    </div>
                  @endif

                  @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                  @endif
                  @csrf
                  <input type="hidden" name="token" value="{{ $token }}">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ $email ?? old('email') }}" tabindex="1" required>
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control pwstrength" name="password" placeholder="Enter password" value="{{ old('password') }}" data-indicator="pwindicator" tabindex="2" required>
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter password" value="{{ old('password_confirmation') }}" tabindex="2" required>
                    <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Reset Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
                Remember It ? <a href="{{  url('') }}/login">Login</a>
            </div>
            <div class="simple-footer">
                Copyright &copy; ACES 2022
                <br>
                <img src="{{ asset('') }}assets/img/tk_logo.jpg" alt="logo" width="200" style="margin-top: 10px">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="{{ asset('') }}assets/modules/jquery.min.js"></script>
  <script src="{{ asset('') }}assets/modules/popper.js"></script>
  <script src="{{ asset('') }}assets/modules/tooltip.js"></script>
  <script src="{{ asset('') }}assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('') }}assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('') }}assets/modules/moment.min.js"></script>
  <script src="{{ asset('') }}assets/js/stisla.js"></script>
  <script src="{{ asset('') }}assets/js/scripts.js"></script>
  <script src="{{ asset('') }}assets/js/custom.js"></script>
</body>
</html>