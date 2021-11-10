@extends('layouts.frontend')

@section('content')
    <div class="pt-16 overflow-hidden">
        <article class="w-full max-w-2xl mx-auto px-4 text-center">
            <h1 class="text-4xl leading-tight tracking-tighter font-medium | lg:text-5xl">
                Laravel Error Tracking
            </h1>
            <p class="text-lg leading-relaxed text-gray-700 mt-4 lg:text-xl">
                Your users do not always report errors, <span class="font-medium">Lara</span><span
                        class="text-primary-500">Bug</span> does.<br />

                <span class="font-medium">Lara</span><span class="text-primary-500">Bug</span> is a simple to use and implement error tracker<br /> built for the Laravel framework
            </p>

            <div class="mt-5 flex justify-center space-x-4">
                <a target="_blank" title="Download on the App Store" href="https://apps.apple.com/nl/app/larabug/id1184315920">
                    <img alt="Download one the App Store" src="{{ asset('images/app/apple-store.svg') }}" />
                </a>
                <a target="_blank" title="Download on the Google Play Store" href="https://play.google.com/store/apps/details?id=com.larabug.mobile">
                    <img alt="Download one the Google Play Store" src="{{ asset('images/app/google-play.svg') }}" />
                </a>
            </div>

            @guest
                @if(config('auth.register_enabled'))
                    <form class="flex flex-col mt-8 | lg:flex-row" method="GET" action="{{ route('register') }}">
                        <input type="email" name="email" class="mb-4 bg-gray-100 placeholder-gray-400 border border-gray-100 rounded px-4 h-12 w-full appearance-none
            | focus:outline-none focus:ring focus:ring-primary-200 focus:bg-white focus:border-primary-200
            | lg:mb-0 lg:mr-4" type="email" placeholder="Enter your email address">
                        <button type="submit" class="mr-4 flex-shrink-0 rounded shadow font-medium text-white tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
              | focus:outline-none focus:ring focus:ring-primary-200 | hover:bg-primary-400">Get
                            started
                        </button>
                    </form>
                @endif
            @endguest
        </article>
        <div class="w-full max-w-6xl mx-auto mt-16 px-4">
            <img class="rounded-t-lg shadow-2xl bg-gray-200"
                 src="{{ asset('images/preview.jpg') }}"
                 alt="LaraBug Dashboard">
        </div>
    </div>

    <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
    <div class="bg-gray-100">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-2">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5">
                <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                    <img class="h-12" src="{{ asset('images/larabug-logo-small.png') }}" alt="LaraBug">
                </div>
            </div>
            <p class="text-gray-500 text-center">
                Your logo here? <a href="https://github.com/sponsors/Cannonb4ll" class="text-primary-500" target="_blank">Consider sponsoring</a>, LaraBug is a free product to track your Laravel exceptions with.
            </p>
        </div>
    </div>

    <section class="py-16 bg-gray-100 | lg:py-32">
        <div class="w-full max-w-6xl mx-auto px-4">
            <h2 class="text-3xl leading-tight tracking-tighter font-medium | lg:text-4xl">
                Ready to go in <span class="text-primary-500">seconds</span>
            </h2>
            <div class="grid gap-8 mt-8 | lg:grid-cols-2 lg:gap-16 lg:mt-16">
                <article>
                    <i class="text-5xl fa-fw fad fa-radar text-primary-500"></i>
                    <h3 class="mt-4 text-2xl leading-tight tracking-tighter font-medium | lg:text-3xl">Discover</h3>
                    <p class="mt-2 text-lg text-gray-600 | lg:text-xl">
                        You might discover errors you didn't know existed. LaraBug helps you solve these.
                    </p>
                </article>
                <article>
                    <i class="text-5xl fa-fw fad fa-rocket text-primary-500"></i>
                    <h3 class="mt-4 text-2xl leading-tight tracking-tighter font-medium | lg:text-3xl">Fast as a
                        rocket</h3>
                    <p class="mt-2 text-lg text-gray-600 | lg:text-xl">
                        LaraBug is designed to be fast. We use the latest techniques to stay fast.
                    </p>
                </article>
                <article>
                    <i class="text-5xl fa-fw fad fa-lightbulb text-primary-500"></i>
                    <h3 class="mt-4 text-2xl leading-tight tracking-tighter font-medium | lg:text-3xl">Ideas to
                        life</h3>
                    <p class="mt-2 text-lg text-gray-600 | lg:text-xl">
                        We are open to new ideas! Submit them using our contact
                        form or contribute to our <a class="text-primary-500" href="https://github.com/LaraBug/LaraBug"
                                                     target="github">github repository</a>.
                    </p>
                </article>
                <article>
                    <i class="text-5xl fa-fw fad fa-bell text-primary-500"></i>
                    <h3 class="mt-4 text-2xl leading-tight tracking-tighter font-medium | lg:text-3xl">Notifications</h3>
                    <p class="mt-2 text-lg text-gray-600 | lg:text-xl">
                        Send notifications to e-mail, Discord or Slack to get notified right away about new exceptions.
                    </p>
                </article>
            </div>
        </div>
    </section>

    @include('frontend.partials.feature-sections')

    <section class="border-t-2 border-gray-100">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div class="grid | lg:grid-cols-2">
                <article class="py-16 relative | lg:pr-16">
                    <i class="text-2xl fa-fw fad fa-quote-left text-primary-500 absolute -mt-2 -ml-4"></i>
                    <p class="text-xl leading-relaxed relative">
                        Easiest service to implement and use, knowing that there are no
                        exceptions helps me focus on developing the platform. And if there
                        are any exceptions not requiring the user to report
                        them to you and having additional data really helps solving them
                    </p>
                    <div class="flex items-center mt-4 | lg:mt-8">
                        <img class="mr-4 h-10 w-10 object-cover rounded-full"
                             src="{{ asset('images/zander.jpg') }}"
                             alt="Person">
                        <div>
                            <p class="font-medium text-lg">Zander vd Meer</p>
                            <p class="text-gray-600">Developer at Meer Development</p>
                        </div>
                    </div>
                </article>
                <article class="py-16 relative border-gray-100 border-t-2 | lg:border-t-0 lg:border-l-2 lg:pl-16">
                    <i class="text-2xl fa-fw fad fa-quote-left text-primary-500 absolute -mt-2 -ml-4"></i>
                    <p class="text-xl leading-relaxed relative">
                        I'm using Larabug since the beginning, its a great service to get your
                        exceptions direct in the mail, on Slack and even on Discord. I fixed a
                        lot of problems because of these notifications.
                    </p>
                    <div class="flex items-center mt-4 | lg:mt-8">
                        <img class="mr-4 h-10 w-10 object-cover rounded-full"
                             src="{{ asset('images/tim.png') }}"
                             alt="Person">
                        <div>
                            <p class="font-medium text-lg">Tim Kwakman</p>
                            <p class="text-gray-600">Founder of CraftingStore</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
