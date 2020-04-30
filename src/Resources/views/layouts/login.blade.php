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

    @yield('css')

</head>
<body>
    <div id="vue-app" class="w-100">
        <main>
            @yield('content')
        </main>
    </div>

    @yield('js')

    <script src="{{ asset('vendor/laravelkit/js/vuecomponents.js') }}"></script>
</body>
</html>
