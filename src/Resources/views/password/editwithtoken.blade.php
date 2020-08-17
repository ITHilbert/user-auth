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
                            <form method="POST" action="{{ route('password.updatewithtoken') }}">
                                @csrf

                                @include('include.message')

                                <input-hidden name="pwtoken" value="{{ $token }}"></input-hidden>
                                <input-hidden name="email" value="{{ $email }}"></input-hidden>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::password.password-new')</label>

                                    <div class="col-md-6">
                                        <input-password id="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('userauth::password.password-confirm')</label>

                                    <div class="col-md-6">
                                        <input-password id="password-confirm" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                </div>


                                {{-- Buttons --}}
                                <div class="form-group row mb-2">
                                    <div class="col-md-4 text-right">

                                    </div>
                                    <div class="col-md-6 text-left">
                                        <button-save>@lang('userauth::button.editPassword')</button-save>
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
