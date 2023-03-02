<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/log.css') }}" rel="stylesheet">
    <style>
        main {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.partials.navbar')
        @include('layouts.partials.section')

        <main class="py-4 px-4">
            <div class="content">
                <div class="row justify-content-center">
                    @include('flash::message')
                    @include('layouts._errors')
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
