@extends('layouts.frontend')

@section('title', 'Page not found')

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    <div class="pt-8 overflow-hidden mb-8">
        <article class="w-full max-w-6xl mx-auto px-4 mb-4">
            <h1 class="text-3xl leading-tight text-center tracking-tighter font-medium mb-4">
                Oh no, we were unable to find this page! 😢
            </h1>
        </article>

        <article class="w-full max-w-6xl mx-auto px-4 text-center">

        </article>
    </div>
@endsection
