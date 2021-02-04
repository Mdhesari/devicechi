<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ $head_title }} </title>

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
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


</head>

<body>

    @inertia

</body>

</html>