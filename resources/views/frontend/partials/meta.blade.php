<link rel="canonical" href="{{ canonical_url() }}" />

<meta name="description" content="@yield('description', 'LaraBug. Insight in errors from your Laravel application')"/>

{{-- Schema.org markup for Google+ --}}
<meta itemprop="name" content="@yield('title', config('app.name'))">
<meta itemprop="description" content="@yield('description', 'Laravel Error Tracking. LaraBug discovers and reports errors, your users do not always report errors, LaraBug does')">
<meta itemprop="image" content="@yield('page_image', asset('images/preview.jpg'))">

{{-- Open Graph data --}}
<meta property="og:locale" content="en_US">
<meta property="og:title" content="@yield('title', config('app.name'))" />
<meta property="og:description" content="@yield('description', 'Laravel Error Tracking. LaraBug discovers and reports errors, your users do not always report errors, LaraBug does')" />
<meta property="og:url" content="{{ canonical_url() }}" />
<meta property="og:image" content="@yield('page_image', asset('images/preview.jpg'))" />
<meta property="og:image:secure_url" content="@yield('page_image', asset('images/preview.jpg'))">
<meta property="og:image:width" content="1662">
<meta property="og:image:height" content="874">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:site_name" content="{{ config('app.name') }}">

{{-- Twitter card data --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@LaraBugEN">
<meta name="twitter:title" content="@yield('title', config('app.name')) ">
<meta name="twitter:description" content="@yield('description', 'Laravel Error Tracking. LaraBug discovers and reports errors, your users do not always report errors, LaraBug does')">
<meta name="twitter:creator" content="@LaraBugEN">
<meta name="twitter:image" content="@yield('page_image',  asset('images/preview.jpg'))">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#d22651">
<meta name="msapplication-TileColor" content="#D22651">
<meta name="theme-color" content="#D22651">
