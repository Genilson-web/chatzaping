<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Styles -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        @media all and (min-width: 768px) {

            /* Apply first set of CSS rules */
            #ground {
                background-image: url("{{asset('images/welcome/first-left.jpg')}}");
                background-color: #8cb751;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                /* opacity: 0.8; */
            }
            #card {
                margin-top: 15%;
                max-width: 350px;
                right: 100px;
            }
        }

        @media not all and (min-width: 768px) {

            /* Apply second set of CSS rules */
            #ground {
                background-image: url("{{asset('images/welcome/first-left.jpg')}}");
                /* background-image: url("public/images/welcome/mobile2.jpg"); */
                background-color: #8cb751;
                background-repeat: no-repeat;
                background-position: center;
                background-attachment: fixed;
                background-size: cover;
            }
            #card {
                margin-top: 20%;
            }
        }
    </style>

</head>

<body>
    <div id="ground" class="container-fluid">
        <div class="row justify-content-end">

            <div class="col-md-5 col-sm-12 vh-100">

                <div id="card" class="p-2">
                   
                    <div class="card p-2" style="background-color: rgba(0, 0, 0, 0.7);">
                        <div class="d-flex justify-content-center">
                            {{-- <img src="{{ asset('public/img/peculiar.png') }}" alt="Peculiar" width="150" height="35"> --}}
                            <h4 class="text-light">ChatZap</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="column mb-2">

                                    <label for="email" class="col-form-label text-md-end text-white">{{ __('Email') }}</label>

                                    <div class="">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="column mb-3">
                                    <label for="password" class="col-form-label text-md-end text-white">{{ __('Senha') }}</label>

                                    <div class="">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="column">
                                    <div class="col-md-10 offset-md-1 d-grid gap-2">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{ __('Entrar') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link link-light" href="{{ route('password.request') }}">
                                                {{ __('Esqueceu a senha?') }}
                                            </a>
                                        @endif
                                        <a class="btn btn-warning btn-sm" href="{{ route('register') }}">
                                            {{ __('Cadastrar') }}
                                        </a>
                                    </div>
                                </div>
{{-- 
                               <div class="d-grid gap-2 mt-3">
                                <a class="btn btn-info btn-sm" href="{{ url('auth/google') }}" type="button" >
                                    <img src="{{asset('public/img/google_icon.png')}}" alt="" height="20" >
                                    Entrar com o Google
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('facebook.login') }}" type="button">
                                    <img src="{{asset('public/img/fb_icon.png')}}" alt="" height="20" >
                                    Entrar com o Facebook
                                 </a>
                               </div> --}}
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
