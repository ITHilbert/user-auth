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
    <link rel="stylesheet" href="{{ asset('vendor/userauth/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravelkit/css/laravelkit.css') }}">

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
                        <card title="@lang('userauth::password.header_pw_forgotten')">
                            <form method="POST" action="{{ route('password.sendtocken') }}">
                                @csrf

                                @include('include.message')

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::login.email')</label>
                                    <div class="col-md-6">
                                        <input-email id="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button-submit>@lang('userauth::button.send')</button-submit>
                                    </div>
                                </div>

                            </form>
                        </card>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('vendor/laravelkit/js/vuecomponents.js') }}"></script>
</body>
</html>
