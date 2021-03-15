<!DOCTYPE html>
<html lang="en">

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

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/favicons/safari-pinned-tab.svg') }}" color="#ff6704">
    <meta name="msapplication-TileColor" content="#ff6704">
    <meta name="theme-color" content="#ff6704">

    <link rel="canonical" href="{{ config('app.url') }}" />
    <!-- Styles -->
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ mix('css/user/normalize.css') }}">
    <link rel="stylesheet" href="{{ mix('css/user/bootstrap-vue.css') }}">

    <link rel="stylesheet" href="{{ mix("css/user/user.css") }}">

    <style>
        body {
            padding-top: 0;
        }
    </style>

</head>

<body>

    <main class="main-site">
        <section class="warnning-section">
            <div class="warnning-holder">
                <h1>@yield('code')</h1>
                <h2>@yield('message')</h2>
                <a href="{{ route('user.home') }}" class="btn btn-back-home">@lang(' Back Home ')</a>
            </div>
        </section>
    </main>
</body>

</html>
