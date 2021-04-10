@extends('layouts.frontend')

@section('title', 'Pricing')

@section('description', 'Pricing information for LaraBug')

@section('content')
    <div class="pt-8 overflow-hidden mb-8">
        <article class="w-full max-w-6xl mx-auto px-4 mb-4">
            <h1 class="text-3xl leading-tight tracking-tighter font-medium mb-4">
                @yield('title')
            </h1>
        </article>

        <section>
            <div class="w-full max-w-6xl mx-auto px-4">
                <a href="{{ route('register') }}" title="Start your 5-day free trial" class="mt-4 flex-shrink-0 rounded shadow text-white font-medium tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
        | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    Get started
                </a>
                @include('frontend.partials.pricing-table')
            </div>
        </section>
    </div>
@endsection
