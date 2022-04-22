<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Feed') || AReal : Augmented Reality 2D Floor Plan Scanner</title>
        <link rel="shortcut icon" href="{{ asset("icon.svg") }}" type="image/x-icon">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href={{ asset('assets/css/feed.css') }} />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        @stack('styles')
    </head>

    <body>
        @include('partials.feed.navigation')
        @include('partials.feed.toast')
        @include('partials.feed.booking')

        <main>
            {{ $slot }}
        </main>

        <!-- Scripts -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        {{-- <script src="{{ asset('assets/js/popup.js') }}"></script> --}}
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            function downloadQr(event, title) {
                html2canvas((event.target.parentElement.firstElementChild)).then((canvas) => downloadURI(canvas.toDataURL(), title + ".png"))
            }

            function downloadURI(uri, name) {
                const link = document.createElement("a");
                link.download = name;
                link.href = uri;
                const node = document.body.appendChild(link);
                link.click();
                node.remove();
            }
        </script>
        @stack('scripts')
    </body>
</html>
