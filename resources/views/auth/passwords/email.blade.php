@extends('layouts.frontend')

@section('title', 'Reset password')

@section('content')
    <div class="pt-16 overflow-hidden mb-8">
        <article class="w-full max-w-2xl mx-auto px-4">
            <h1 class="text-4xl leading-tight tracking-tighter font-medium | lg:text-5xl">
                @yield('title')
            </h1>

            @if(session('status'))
                <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block">{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" class="w-full mt-8" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email address
                    </label>
                    <input type="email" name="email" id="email" class="mb-4 bg-gray-100 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:shadow-outline focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('email') border border-red-500 @enderror" type="email" placeholder="Enter your email address">

                    @error('email')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <button class="mb-4 mr-4 flex-shrink-0 rounded shadow font-medium text-white tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
          | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    {{ __('Reset password') }}
                </button>

                <a class="text-primary-500" href="{{ route('login') }}">Login</a>
            </form>
        </article>
    </div>
@endsection
