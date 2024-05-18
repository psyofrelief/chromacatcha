<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="{{ asset('build/assets/app-18g5PMMB.css') }}" rel="stylesheet">
    <script src="{{ asset('build/assets/app-CTu84iEe.js') }}" defer></script>
</head>

<body class="min-h-screen flex flex-col relative text-center font-spaceMono">

    <x-navbar />

    @yield('content')

    <x-footer />

    @yield('scripts')

</body>

</html>
