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
    <link rel="stylesheet" href="{{ asset('css/pico.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://css.gg/css' rel='stylesheet'>

    <link rel="icon" type="img/png" href="{{ asset('img/favicon.png') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body>
    @include('layouts.navigation')
    <!-- Page Heading -->

    <main class="container">
        <header>
            <h2>{{ $header }}</h2>
        </header>
        <section>
            {{ $slot }}
        </section>
        <footer class="container-fluid">
            <hr>
            <p><small>Copyright</small></p>
        </footer>
    </main>

</body>

</html>
