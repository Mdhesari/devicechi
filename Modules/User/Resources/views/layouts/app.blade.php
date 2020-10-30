<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/user/normalize.css') }}">
    <link rel="stylesheet" href="{{ mix('css/user/bootstrap-vue.css') }}">
    <link rel="stylesheet" href="{{ mix('css/user/bootstrap-rtl.css') }}">

    <link rel="stylesheet" href="{{ mix("css/user/user.css") }}">

    <!-- Scripts -->
    <script>
        window.default_locale = "{{ config('app.locale') }}"
        window.fallback_locale = "{{ config('app.fallback_locale') }}"
        window.messages = @json($messages)
    </script>
    <script src="{{ mix('js/user/moment.js') }}"></script>
    <script src="{{ mix('js/user/user.js') }}" defer></script>


</head>

<body class="font-sans antialiased">

    @inertia

</body>

</html>