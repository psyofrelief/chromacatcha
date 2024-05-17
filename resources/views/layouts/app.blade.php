<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ mix('public/build/assets/app-CBTPaFpW.css') }}" rel="stylesheet">
    <script src="{{ mix('public/build/assets/app-DkDdL2UM.js') }}" defer></script>

</head>

<body class="min-h-screen flex flex-col text-center ">

    <img id="bg-img" alt="cloud bg" src="{{ asset('/img/cloud-bg.svg') }}" class="fixed z-[-1] bottom-0 left-0 right-0 w-full" />
    <x-navbar />

    @yield('content')
    <x-footer />
    @yield('scripts')
</body>

</html>
