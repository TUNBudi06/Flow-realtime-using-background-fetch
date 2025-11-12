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

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-brand-pink-100 relative dark:bg-brand-pink-800 text-brand-pink-800" x-data="{
    sidebarOpen: false
}">
    <livewire:notification />
    <!-- Navbar -->
    <nav class="bg-brand-pink-300 fixed top-0 w-full z-2 dark:bg-gray-900 border-b border-brand-pink-200 dark:border-gray-800">
        <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">ISEKI Flow</span>
                    </a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Main Menu for Authenticated Users -->
                        <div class="hidden md:flex items-center space-x-6">
                            <x-navbar />
                        </div>

                        <livewire:auth.logout />
                    @else
                        <!-- Login Button for Guests -->
                        @if(Route::has('login'))
                            @if(!Route::is('login'))
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 dark:bg-white border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-900 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-100 transition">
                                    Login
                                </a>
                            @else
                                <a href="{{ route('home') }}" class="text-gray-700 px-2 py-3 rounded-xl data-[active=true]:bg-gray-300 dark:text-gray-300 dark:data-[active=true]:bg-gray-500 hover:text-gray-900 dark:hover:text-white transition" data-active="{{Route::is('home')?'true':'false'}}">
                                    Dashboard
                                </a>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')
    @livewireScriptConfig
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @stack('scripts')
    @stack('scripts-def')
</body>
</html>
