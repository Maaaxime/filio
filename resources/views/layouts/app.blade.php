<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bulma-navs.custom.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma.custom.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma-steps.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bulma-steps.custom.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma-tooltip.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma-list.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma-sweetalert2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bulma-divider.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/picker.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/picker.custom.css') }}">    

    <link rel="stylesheet" href="{{ asset('css/sortable-theme-minimal.css') }}">

    <script src="https://kit.fontawesome.com/19514b6620.js" crossorigin="anonymous"></script>
    <link href='https://css.gg/css' rel='stylesheet'>

    <link rel="icon" type="img/png" href="{{ asset('img/favicon.png') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sortable.min.js') }}"></script>
    <script src="{{ asset('js/bulma.custom.js') }}"></script>

    @yield('stylesheets')
</head>

<body>
    <x-banner />
    {{ $slot }}

    @yield('scripts')
</body>
</html>
