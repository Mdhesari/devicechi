<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#ff6704">
    <meta name="msapplication-TileColor" content="#ff6704">
    <meta name="theme-color" content="#ff6704">

    <link rel="canonical" href="{{ config('app.name') }}" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/user/normalize.css') }}">
    <link rel="stylesheet" href="{{ mix('css/user/bootstrap-vue.css') }}">

    <link rel="stylesheet" href="{{ mix("css/user/user.css") }}">
    <link rel="stylesheet" href="{{ mix("css/user/swiper.css") }}">

    <!-- Scripts -->
    <script>
        window.default_locale = "{{ config('app.locale') }}"
        window.fallback_locale = "{{ config('app.fallback_locale') }}"
        window.messages = @json($messages)
    </script>

    @routes
    <script src="{{ mix('js/user/moment.js') }}"></script>
    <script src="{{ mix('js/user/user.js') }}" defer></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body>

    @inertia

</body>

</html>