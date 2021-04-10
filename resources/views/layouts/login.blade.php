<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title', 'Welcome') - {{ config('app.name') }}</title>

    @include('parts.meta')

    <link href="{{ mix('css/panel.css') }}" rel="stylesheet" type="text/css"/>

    @stack('scriptsHeader')
    @stack('styles')
</head>
<body>
<div id="page-container">
    <main id="main-container">
        @yield('content')
    </main>
</div>
</body>
</html>
