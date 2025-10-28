<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection('title')
        <title>@yield('title')</title>
    @else
        <title>ISEKI | Dashboard</title>
    @endif
    <link rel="icon" href="{{asset('favicon.ico')}}" sizes="any">
    <link rel="icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">

    <!-- Styles / Scripts -->
    @livewireStyles
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">

@livewireScriptConfig
</body>
</html>
