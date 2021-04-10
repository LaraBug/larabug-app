@extends('layouts.frontend')

@section('title', 'Login')

@section('content')
    <div class="pt-16 overflow-hidden mb-8">
        <article class="w-full max-w-2xl mx-auto px-4">
            <h1 class="text-4xl leading-tight tracking-tighter font-medium | lg:text-5xl">
                Login
            </h1>
            <form class="w-full mt-8 space-y-4 mb-8" method="post" action="{{ route('login') }}">
                @csrf
                @honeypot
                @error('provider')
                    <div class="bg-red-100 mb-8 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block">{{ $message }}</span>
                    </div>
                @enderror

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" autofocus id="email" class="mb-4 bg-gray-100 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:shadow-outline focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('email') border border-red-500 @enderror" type="email" placeholder="Enter your email address">

                    @error('email')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input type="password" name="password" id="password" class="mb-4 bg-gray-100 border border-gray-100 rounded px-4 h-12 w-full appearance-none
        | focus:outline-none focus:shadow-outline focus:bg-white focus:border-primary-200
        | lg:mb-0 lg:mr-4 @error('password') border border-red-500 @enderror" type="email" placeholder="Enter your password">

                    @error('password')
                    <p class="text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember_me" {{ old('remember') ? 'checked' : '' }} name="remember" type="checkbox" class="form-checkbox h-4 w-4 text-primary-500 transition duration-150 ease-in-out">
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                        Remember me
                    </label>
                </div>

                <button class="mr-4 flex-shrink-0 rounded shadow font-medium text-white tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
          | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    {{ __('Login') }}
                </button>

                <a class="text-primary-500 mr-4 border-r pr-5" href="{{ route('socialite.login', 'github') }}">Github Login</a>
                <a class="text-primary-500" href="{{ route('password.request') }}">Forgot password</a>
            </form>
        </article>
    </div>
@endsection
