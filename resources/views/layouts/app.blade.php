<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <title>Riset Inovasi dan Expo</title>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Others CSS -->
    @yield('t-script')
</head>

<body>

    <!-- Header -->
    <x-header></x-header>
    <!-- End Header -->

    <div id="app">
        <!-- Content -->
        @yield('content')
        <!-- End Content -->
    </div>

    <footer class="footer">
        <x-footer></x-footer>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
        async></script>
    <!-- Others JS -->
    @stack('b-script')
</body>

</html>