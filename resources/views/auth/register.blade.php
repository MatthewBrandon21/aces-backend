<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ACES - {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/jquery-selectric/selectric.css">
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{ asset('') }}assets/img/Logo Aces Horizontal.png" alt="logo" width="250">
            </div>
            <div class="card card-primary">
              <div class="card-body">
                <form action="{{  url('') }}/register" method="POST">
                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus required>
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                      @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator" name="password" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="passwordconfirm" class="d-block">Password Confirmation</label>
                      <input id="passwordconfirm" type="password" class="form-control @error('passwordconfirm') is-invalid @enderror" name="passwordconfirm" required>
                      @error('passwordconfirm')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
                have an account? <a href="{{  url('') }}/login">Login</a>
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
  <script src="{{ asset('') }}assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="{{ asset('') }}assets/js/page/auth-register.js"></script>
  <script src="{{ asset('') }}assets/js/scripts.js"></script>
  <script src="{{ asset('') }}assets/js/custom.js"></script>
</body>
</html>