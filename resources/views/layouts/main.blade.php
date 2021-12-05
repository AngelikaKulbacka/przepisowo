<!DOCTYPE html>
<html lang="pl" class="h-100">
    <head>
        <title>Przepisowo - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="/css/app.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="/js/app.js"></script>
    </head>
    <body class="h-100">
      <nav class="navbar navbar-expand-md navbar-dark bg-light pb-0" >
        <div class="main-container main-header container-fluid">
          <div class="col" style="width: calc(100% - 280px); flex: 0 0 auto;">
          <a class="navbar-brand" href="/"> <img src="{{ url('storage/images/przepisowo.png') }}" alt="logo"></a>
          </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="nav navbar-nav-right justify-content-end">
                @guest
                <div class="col-md-6 col-6 col-lg-2 my-3" style="width:130px; flex: 0 0 auto;">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Zaloguj się</button>
                </div>
                <div class="col-md-6 col-6 col-lg-2 my-3" style="width:150px; flex: 0 0 auto;">
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#signupModal">Zarejestruj się</button>
                </div>
            @endguest
            @auth
                <div class="col-md-6 col-6 col-lg-2 my-3 mr-5" style="width:50px; flex: 0 0 auto;">
                    <a class="btn btn-primary" href="/przepis/ulubione"><i class="fas fa-heart"></i></a>
                </div>
                <div class="col-md-6 col-6 col-lg-2 my-3 mr-5" style="width:50px; flex: 0 0 auto;">
                    <a class="btn btn-light" href="/profil"><i class="fas fa-user"></i></a>
                </div>
                <div class="col-md-6 col-6 col-lg-2 my-3 mr-5" style="width:50px; flex: 0 0 auto;">
                    <div class="dropdown">
                        <button class="btn btn-light" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bars"></i></button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="/profil">Mój profil</a></li>
                            <li><a class="dropdown-item" href="/przepis/ulubione">Ulubione</a></li>
                            <li><a class="dropdown-item" href="/przepis/moje">Moje przepisy</a></li>
                            <li><a class="dropdown-item" href="{{route('auth.logout')}}">Wyloguj się</a></li>
                        </ul>
                    </div>
                </div>
            @endauth
                    </ul> 
            </div>
        </div>
        </div>
      </nav>
        <div class='main-container container'>
            <div class="row" style="min-height: 100%">
                <div class="col container py-5" style="max-width: 1320px; background: #131C38; color: white;">
                    @yield('content')
                </div>
            </div>
            <div class="main-footer row">
                <div class="col"></div>
            </div>
        </div>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content modal-centred">
                <div class="modal-header">
                  <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('auth.login') }}" id="loginForm">
                    @csrf
                        <div class="mb-3">
                          <label for="loginInput" class="form-label">Login</label>
                          <input type="text" name="login" class="form-control login" id="loginInput" value="{{ old('login') }}">
                        </div>
                        <div class="mb-3">
                          <label for="passwordInput" class="form-label">Hasło</label>
                          <input type="password" name="password" class="form-control login" id="passwordInput">
                        </div>
                        <div class="mb-3">
                        <span class="text-danger">{{ $errors->login->first() }}</span>
                        </div>
                        <div class="mt-5 buttons">
                            <button type="submit" class="btn btn-primary">Zaloguj się</button>
                        </div>
                      </form>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content modal-centred">
                <div class="modal-header">
                  <h5 class="modal-title" id="signupModalLabel">Zarejestruj się</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('auth.register') }}" id="signupForm">
                    @csrf
                        <div class="mb-3">
                          <label for="signup-nameInput" class="form-label">Imię</label>
                          <input type="text" name="name" class="form-control signup @if($errors->register->any()) @if($errors->register->has('name')) is-invalid @else is-valid @endif @endif" id="signup-nameInput" value="{{ old('name') }}">
                          <div class="invalid-feedback">
                          {{ $errors->register->first('name') }}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="signup-lastnameInput" class="form-label">Nazwisko</label>
                          <input type="text" name="lastName" class="form-control signup @if($errors->register->any()) @if($errors->register->has('lastName')) is-invalid @else is-valid @endif @endif" id="signup-lastnameInput" value="{{ old('lastName') }}">
                          <div class="invalid-feedback">
                          {{ $errors->register->first('lastName') }}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="signup-emailInput" class="form-label">Email</label>
                          <input type="text" name="email" class="form-control signup @if($errors->register->any()) @if($errors->register->has('email')) is-invalid @else is-valid @endif @endif" id="signup-emailInput" value="{{ old('email') }}">
                          <div class="invalid-feedback">
                          {{ $errors->register->first('email') }}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="signup-loginInput" class="form-label">Login</label>
                          <input type="text" name="login" class="form-control signup @if($errors->register->any()) @if($errors->register->has('login')) is-invalid @else is-valid @endif @endif" id="signup-loginInput" value="{{ old('login') }}">
                          <div class="invalid-feedback">
                          {{ $errors->register->first('login') }}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="signup-passwordInput" class="form-label">Hasło</label>
                          <input type="password" name="password" class="form-control signup @if($errors->register->any()) @if($errors->register->has('password')) is-invalid @else is-valid @endif @endif" id="signup-passwordInput">
                          <div class="invalid-feedback">
                          {{ $errors->register->first('password') }}
                          </div>
                        </div>
                        <div class="mb-3">
                            <label for="signup-passwordAccInput" class="form-label">Podtwierdź hasło</label>
                            <input type="password" name="passwordConfirm" class="form-control signup @if($errors->register->any()) @if($errors->register->has('passwordConfirm')) is-invalid @endif @endif" id="signup-passwordAccInput">
                            <div class="invalid-feedback">
                          {{ $errors->register->first('passwordConfirm') }}
                          </div>
                          </div>
                        <div class="mt-5 buttons">
                            <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                        </div>
                      </form>
                </div>
              </div>
            </div>
        </div>
        <script>
          $( document ).ready(function() {
            console.log("{{$errors->register->isNotEmpty()}}");
            if("{{$errors->register->isNotEmpty()}}")
              $('#signupModal').modal('show');
            console.log("{{$errors->login->isNotEmpty()}}");
            if("{{$errors->login->isNotEmpty()}}" || "{{isset($showLogin) && $showLogin}}")
              $('#loginModal').modal('show');
            $("#loginModal").on('hidden.bs.modal', function(){
                $("input.login").val('');
                $("input.signup").val('');
                $("input.login").removeClass('is-valid').removeClass('is-invalid');
            });
            $("#signupModal").on('hidden.bs.modal', function(){
              $("input.signup").val('');
              $("input.login").val('');
              $("input.signup").removeClass('is-valid').removeClass('is-invalid');
            });
          });
        </script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha512-ldc1sPu1FZ8smgkgp+HwnYyVb1eRn2wEmKrDg1JqPEb02+Ei4kNzDIQ0Uwh0AJVLQFjJoWwG+764x70zy5Tv4A==" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e264c94639.js" crossorigin="anonymous"></script>
    </body>
</html>
