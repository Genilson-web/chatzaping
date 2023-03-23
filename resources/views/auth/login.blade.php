@extends('layouts.app')
@section('content')
<style>
    @media all and (min-width: 768px) {

        /* Apply first set of CSS rules */
        #ground {
            background-image: url("{{asset('images/welcome/login.jpg')}}");
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        #card {
            margin-top: 15%;
            max-width: 350px;
            /* right: 80px; */
        }
    }

    @media not all and (min-width: 768px) {

        /* Apply second set of CSS rules */
        #ground {
            background-image: url("{{asset('images/welcome/middle.jpg')}}");
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
    <div id="ground" class="row justify-content-end">

        <div class="col-md-4 col-sm-12 vh-100">

            <div id="card" class="p-2">

                <div class="card p-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="d-flex justify-content-center">
                        <h4 class="text-light">ChatZap</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="column mb-2">

                                <label for="email" class="col-form-label text-md-end text-white">{{ __('Email')
                                    }}</label>

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
                                <label for="password" class="col-form-label text-md-end text-white">{{ __('Senha')
                                    }}</label>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection