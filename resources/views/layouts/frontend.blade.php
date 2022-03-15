<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <title>@yield('title', 'Laravel Error Tool') - {{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/frontend.css') }}">

    @include('frontend.partials.meta')

    @if(!app()->isLocal())
        @include('frontend.partials.analytics')
    @endif
</head>
<body class="flex flex-col w-full min-h-screen font-sans antialiased text-gray-900">
@if(!config('larabug.minimal_frontend'))
<div class="relative bg-red-700">
    <div class="max-w-screen-xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="pr-16 sm:text-center sm:px-16">
            <p class="font-medium text-white">
                <span>
                  LaraBug is free!
                </span>
                <span class="block sm:ml-2 sm:inline-block">
                  <a href="https://github.com/sponsors/Cannonb4ll" class="text-white font-bold underline">
                      Support the development &rarr;
                  </a>
                </span>
            </p>
        </div>
    </div>
</div>
@endif

@if(!config('larabug.minimal_frontend'))
@include('frontend.partials.header')
@else
@include('exceptions.partials.header')
@endif

<main class="flex-grow">
    @yield('content')
</main>

@if(!config('larabug.minimal_frontend'))
@include('frontend.partials.footer')
@endif

<script src="{{ mix('js/frontend.js') }}"></script>

@include('cookie-consent::index')

@stack('scripts')

<script src="https://analytics.webbuilds.nl/tracker.js" data-domain="www.larabug.com" defer></script>
</body>
</html>
