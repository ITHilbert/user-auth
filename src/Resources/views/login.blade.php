<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('meta')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        html, body {
            background-image: URL({{ asset('vendor/userauth/img/sky-49520.jpg') }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>
<body>
    <div id="vue-app" class="w-100">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <j-card title="@lang('userauth::login.header')">
                            <div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::login.email')</label>

                                        <div class="col-md-6">
                                            <input-email id="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::login.password')</label>

                                        <div class="col-md-6">
                                            <input-password id="password" name="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    @lang('userauth::login.remember')
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="{{ route('password.forgotten') }}">@lang('userauth::login.pwforgotten')</a>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button-submit>@lang('userauth::button.login')</button-submit>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </j-card>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
