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
                            Wir haben Ihnen den link zum ändern des Passworts zugesandt.<br>
                            Bitte überprüfen Sie Ihr Postfach. Sollten Sie dort nicht finden, dann schauen Sie bitte auch in Ihren <b>Spam</b> Ordner.
                        </card>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('vendor/laravelkit/js/vuecomponents.js') }}"></script>
</body>
</html>
