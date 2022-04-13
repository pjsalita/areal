<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Home') || AReal : Augmented Reality 2D Floor Plan Scanner</title>
        <link rel="shortcut icon" href="icon.svg" type="image/x-icon">

        <!-- Stylesheets -->
        <link rel="stylesheet" href={{ asset('assets/css/aos.css') }} />
        <link rel="stylesheet" href={{ asset('assets/css/main.css') }} />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

        @stack('styles')
    </head>

    <body>
        @include("partials.navigation")

        <main>
            {{ $slot }}
        </main>

        @include("partials.footer")
        @include("partials.back-to-top")
        @include("partials.auth")

        <!-- Scripts -->
        <script src="{{ asset('assets/js/modal.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/calendar.js') }}"></script> --}}
        <script src="{{ asset('assets/js/aos.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script>AOS.init();</script>

        @stack('scripts')

    </body>
</html>
