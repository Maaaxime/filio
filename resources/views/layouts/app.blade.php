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
    <link href='https://css.gg/css' rel='stylesheet'>

    <link rel="icon" type="img/png" href="{{ asset('img/favicon.png') }}">

    <style>
        body {
            padding-top: calc(1rem + var(--spacing) * 2);
        }

        nav,
        nav ul {
            display: flex;
        }

        body>nav {
            z-index: 99;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            padding: 0 var(--spacing);
            background-color: var(--card-background-color);
            box-shadow: var(--card-box-shadow);
        }

        nav {
            justify-content: space-between;
        }

        body>header,
        body>main {
            padding: var(--block-spacing-vertical) var(--block-spacing-horizontal);
        }

        body>footer {
            padding: 1rem 0;
        }

        .error {
            color: var(--del-color);
        }

        .btn-icon {
            width: 100%;
            justify-content: space-between;
            flex: 1;
            display: flex;
            align-items: center;

            min-width: 160px;
        }

        i {
            display: inline-block !important;
        }

        .img-circle {
            border-radius: 50%;
        }

        .h-10 {
            height: 2.5rem;
        }

        .w-10 {
            width: 2.5rem;
        }

        table td,
        table tr,
        table td * {
            vertical-align: middle;
        }

        .flex {
            display: flex
        }

        .flex-shrink-0,
        .shrink-0 {
            flex-shrink: 0
        }

        .btn-info {
            color: #fff;
            background-color: #5bc0de;
            border-color: #46b8da;
        }

        .btn-info:hover {
            color: #fff;
            background-color: #31b0d5;
            border-color: #269abc;
        }

        .btn-warning {
            color: #fff;
            background-color: #f0ad4e;
            border-color: #eea236;
        }

        .btn-warning:hover {
            color: #fff;
            background-color: #ec971f;
            border-color: #d58512;
        }

        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #449d44;
            border-color: #398439;
        }

        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .logo {
            display: none;
            background-color: #374956;
            background-image: url(https://source.unsplash.com/GagC07wVvck/1000x1200);
            background-position: center;
            background-size: cover;
        }

        @media (min-width: 992px) {
            .grid>.logo {
                display: block;
            }
        }

        /* Footer */
        body>footer {
            padding: 1rem 0;
        }


        article>div {
            padding: 1rem;
        }

        @media (min-width: 576px) {
            body>main {
                padding: 1.25rem 0;
            }

            article>div {
                padding: 1.25rem;
            }
        }

        @media (min-width: 768px) {
            body>main {
                padding: 1.5rem 0;
            }

            article>div {
                padding: 1.5rem;
            }
        }

        @media (min-width: 992px) {
            body>main {
                padding: 1.75rem 0;
            }

            article>div {
                padding: 1.75rem;
            }
        }

        @media (min-width: 1200px) {
            body>main {
                padding: 2rem 0;
            }

            article>div {
                padding: 2rem;
            }
        }

    </style>
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
