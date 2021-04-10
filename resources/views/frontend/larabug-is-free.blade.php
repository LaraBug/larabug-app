@extends('layouts.frontend')

@section('title', 'LaraBug is free')

@section('content')
    <div class="relative py-16 bg-white overflow-hidden">
        <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:h-full lg:w-full">
            <div class="relative h-full text-lg max-w-prose mx-auto">
                <svg class="absolute top-12 left-full transform translate-x-32" width="404" height="384" fill="none"
                     viewBox="0 0 404 384">
                    <defs>
                        <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20"
                                 patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                        </pattern>
                    </defs>
                    <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)"/>
                </svg>
                <svg class="absolute top-1/2 right-full transform -translate-y-1/2 -translate-x-32" width="404"
                     height="384" fill="none" viewBox="0 0 404 384">
                    <defs>
                        <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20"
                                 patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                        </pattern>
                    </defs>
                    <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)"/>
                </svg>
            </div>
        </div>
        <div class="relative px-4 sm:px-6 lg:px-8">
            <div class="text-lg max-w-prose mx-auto mb-6">
                <p class="text-base text-center leading-6 text-primary-600 font-semibold tracking-wide uppercase">Free
                    forever</p>
                <h1 class="mt-2 mb-8 text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    LaraBug is free</h1>
                <p class="text-xl text-gray-500 leading-8">
                    We want to make tracking exceptions funner and easier. Especially for newcomers, we want to give
                    them the best experience to track exceptions.
                </p>
            </div>
            <div class="prose prose-lg text-gray-500 mx-auto">
                <p>
                    We've decided to change the business structure of LaraBug, making it completely
                    <strong>free</strong>, forever.
                </p>

                <p>
                    This is how the new structure will look like:
                </p>
                <ul>
                    <li><strong>Website</strong>: closed source, but completely free to use</li>
                    <li><strong>Package</strong>: open source and welcome to receive PRs that improve the package</li>
                    <li><strong>Sponsors</strong>: we will be opening GitHub sponsors to receive a small amount of
                        funding to keep LaraBug going
                    </li>
                </ul>
                <p>
                    LaraBug has costs each month; it has a domain name, transactional emails and a server to be paid,
                    and development on LaraBug costs money. That's why we're opening up the ability to <a
                            href="https://github.com/sponsors/Cannonb4ll" target="sponsor" title="Sponsor LaraBug">sponsor
                        us</a> if you'd like to.
                </p>
                <p>
                    All money received via GitHub sponsors will be spent on the domain name, server & development costs
                    for improving LaraBug.
                </p>
                <span class="inline-flex rounded-md shadow-sm">
                  <a href="https://github.com/sponsors/Cannonb4ll" target="sponsor" title="Sponsor LaraBug"
                     class="inline-flex items-center px-6 py-3 border border-gray-300 text-base leading-6 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                Sponsor LaraBug
                  </a>
                </span>
            </div>

            <div class="bg-white">
                <div class=" max-w-prose mx-auto py-16 sm:py-24 space-y-8">
                    <h2 class="text-3xl leading-9 font-extrabold text-gray-900">
                        Frequently asked questions
                    </h2>

                    <div class="border-t border-gray-200 pt-10">
                        <dl class="space-y-10 md:grid md:col-gap-8 md:row-gap-12">
                            <div class="space-y-2">
                                <dt class="text-lg leading-6 font-medium text-gray-900">
                                    Free? So there must be some other catch, then?
                                </dt>
                                <dd class="text-base leading-6 text-gray-500">
                                    No, there's no catch. We do not resell data or send any of your data to third
                                    parties.
                                    We only track analytics with a Matomo instance to see how much visitors we get. The
                                    panel
                                    itself is not monitored by this tracker.
                                </dd>
                            </div>

                            <div class="space-y-2">
                                <dt class="text-lg leading-6 font-medium text-gray-900">
                                    Are there limitations?
                                </dt>
                                <dd class="text-base leading-6 text-gray-500">
                                    We rotate data to keep our services clean and fast, we rotate any exception data
                                    older than 30 days.
                                    You are also limited to 30 exceptions per minute before rate limiting takes in
                                    place.
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <h2 class="text-3xl leading-9 font-extrabold text-gray-900">
                        Our lovely sponsors
                    </h2>

                    <div class="mt-12 flex flex-wrap -ml-4">
                        @foreach($sponsors as $sponsor)
                            <div class="w-full md:w-1/2 pl-4 pb-4">
                                <div class="rounded flex items-center">
                                    <a  target="_blank"
                                            class="text-blue-700 hover:text-orange-700 font-medium underline"
                                            href="https://github.com/{{ $sponsor->username }}">
                                        <img class="w-16 h-16 rounded shadow"
                                             alt="{{ $sponsor->username }}"
                                             src="{{ $sponsor->avatar }}&s=150"></a>
                                    <div class="pl-4 leading-none">
                                        <a target="_blank" href="https://github.com/{{ $sponsor->username }}"
                                           class="text-base font-bold text-gray-700">{{ $sponsor->username }}</a>
                                        <div class="mt-2 text-sm text-gray-600">Sponsor
                                            since {{ $sponsor->created_at->format('M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
