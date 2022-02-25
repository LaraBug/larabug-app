@extends('layouts.frontend')

@section('title', 'Register')

@section('content')
    <div class="pt-16 overflow-hidden mb-8">
        <article class="w-full max-w-2xl mx-auto px-4">
            <h1 class="text-4xl leading-tight tracking-tighter font-medium | lg:text-5xl pb-4">
                Register
            </h1>

            <ul class="leading-relaxed text-gray-700">
                <li><i class="fad fa-check text-green-500 mr-2"></i> Specially designed for Laravel applications</li>
                <li><i class="fad fa-check text-green-500 mr-2"></i> Publicly share exceptions</li>
                <li><i class="fad fa-check text-green-500 mr-2"></i> No credit card required</li>
            </ul>

            <form class="w-full mt-8" method="post" action="{{ route('register') }}">
                @csrf
                @honeypot
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email address
                    </label>
                    <input type="email" value="{{ old('email', request('email')) }}" name="email" id="email" class="mb-4 bg-gray-100 placeholder-gray-400 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:ring focus:ring-primary-200 focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('email') border border-red-500 @enderror" type="email"
                           placeholder="Enter your email address">

                    @error('email')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="mb-4 bg-gray-100 placeholder-gray-400 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:ring focus:ring-primary-200 focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('email') border border-red-500 @enderror" type="email" placeholder="Enter your name">

                    @error('name')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input type="password" name="password" id="password" class="mb-4 bg-gray-100 placeholder-gray-400 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:ring focus:ring-primary-200 focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('password') border border-red-500 @enderror" type="email"
                           placeholder="Enter your password">

                    @error('password')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        Repeat password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mb-4 bg-gray-100 placeholder-gray-400 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:ring focus:ring-primary-200 focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('password_confirmation') border border-red-500 @enderror" type="email"
                           placeholder="Enter your password">

                    @error('password_confirmation')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <button class="mb-4 mr-4 flex-shrink-0 rounded shadow font-medium text-white tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
          | focus:outline-none focus:ring focus:ring-primary-200 | hover:bg-primary-400">Get
                    started
                </button>

                @if(config('services.github.client_id') && config('services.github.client_secret'))
                <a class="text-primary-500 mr-4 border-r pr-5" href="{{ route('socialite.login', 'github') }}">GitHub Login</a>
                @endif
                <a class="text-primary-500" href="{{ route('login') }}">Login</a>
            </form>
        </article>
    </div>
@endsection
