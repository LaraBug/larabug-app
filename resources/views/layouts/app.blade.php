<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') - {{ config('app.name', 'LaraBug') }}</title>

    @include('parts.meta')

    <link href="{{ mix('css/panel.css') }}" rel="stylesheet">

    @stack('css')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'echoHost' => env('ECHO_HOST'),
            'user' => auth()->check() ? auth()->user()->id : null,
            'locale' => app()->getLocale()
        ]) !!};
    </script>

</head>
<body>

<div id="page-container"
     class="sidebar-o  enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">

    @include('parts.backend-navigation')

    @include('parts.sidebar')

    <main id="main-container">

        @yield('content')
    </main>

    @include('parts.footer')
</div>


<script src="{{ mix('js/app.js') }}"></script>

@stack('javascript')

@if(env('APP_ENV') != 'local')
    @include('parts.analytics')
@endif
</body>
</html>
