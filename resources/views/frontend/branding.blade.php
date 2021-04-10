@extends('layouts.frontend')

@section('title', 'Branding')
@section('description', 'We\'ve put together a pack of logo\'s for you to show off with on your website or community, use it in a news item, blog item or press release.')
@section('page_image', asset('images/stickers/sticker-1.png'))

@section('content')
    <div class="pt-8 overflow-hidden mb-8">
        <article class="w-full max-w-6xl mx-auto px-4 mb-4">
            <div class="flex flex-wrap -mx-2 mb-8 md:mb-16">
                <div class="w-full md:w-1/2 p-6">
                    <h2 class="text-2xl text-navy-500 pb-4" id="branding-kit-for-you-to-show-off-with">
                        Branding kit for you to show off
                        with @include('frontend.partials.hashtag-link', ['id' => 'branding-kit-for-you-to-show-off-with'])
                    </h2>

                    <p class="pb-4 leading-relaxed">
                        We've put together a pack of logo's for you to show off with on your website or community.
                    </p>
                    <p class="pb-4 leading-relaxed">
                        Scroll down to find out more information about our logo, rules & guidelines. You will also find
                        a link
                        to download the complete kit.
                    </p>
                </div>
                <div class="w-full md:w-1/2 p-6">
                    <img src="{{ asset('images/stickers/sticker-1.png') }}" class="mx-auto w-6/12"/>
                </div>
            </div>

            <div class="flex flex-wrap-reverse md:flex-wrap -mx-2 mb-8 md:mb-16">
                <div class="w-full md:w-2/4 p-6">
                    <img src="{{ asset('images/stickers/sticker-2.png') }}" class="mx-auto w-10/12"/>
                </div>

                <div class="w-full md:w-2/4 p-6">
                    <h2 class="text-2xl text-navy-500 pb-4" id="styles-and-guidelines">
                        Styles & guides @include('frontend.partials.hashtag-link', ['id' => 'styles-and-guidelines'])
                    </h2>

                    <p class="pb-8 text-navy-500">
                        You write our name as "LaraBug".
                        The specific
                        detail comes when you look at the TLD in our name. The "Lara" part is bold while the "bug.com" part
                        is normal font weight and has the primary color shade.
                    </p>

                    <p class="pb-8 text-navy-500">
                        An example is: <strong>Lara</strong><span class="text-primary-500">Bug.com</span>
                    </p>

                    <p class="pb-8 text-navy-500">
                        The font family we use is "Rubik", where we use a line height of 1.5 & font size of
                        1rem on our website.
                    </p>

                    <table class="table-auto w-full text-navy-500">
                        <thead>
                        <tr>
                            <th class=" py-2 text-left">Name</th>
                            <th class=" py-2 text-left">HEX</th>
                            <th class=" py-2 text-left">Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class=" py-2">Primary color</td>
                            <td class=" py-2">#D22651</td>
                            <td class=" py-2">
                                <div class="bg-primary-500 h-5 w-full rounded shadow-lg"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class=" py-2">Primary dark shade</td>
                            <td class=" py-2">#7E1731</td>
                            <td class=" py-2">
                                <div class="bg-primary-700 h-5 w-full rounded shadow-lg"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class=" py-2">Primary light shade</td>
                            <td class=" py-2">#EDA8B9</td>
                            <td class=" py-2">
                                <div class="bg-primary-300 h-5 w-full rounded shadow-lg"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-wrap -mx-2 mb-8 md:mb-16">
                <div class="w-full md:w-2/3 p-6">
                    <h2 class="text-2xl text-navy-500 pb-4" id="dos-and-donts">
                        TL;DR: do's & dont's @include('frontend.partials.hashtag-link', ['id' => 'dos-and-donts'])
                    </h2>

                    <div class="px-2 mb-8">
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full md:w-1/2 px-2">
                                <h3 class="text-xl text-navy-500 pb-4">
                                    Do's
                                </h3>
                                <div class="text-navy-500">
                                    <ul>
                                        <li><i class="far fa-check fa-fw text-green-500"></i> Use the <strong>Lara</strong><span class="text-primary-500">Bug</span> logo in blog
                                            posts or news articles
                                        </li>
                                        <li><i class="far fa-check fa-fw text-green-500"></i> Use the <strong>Lara</strong><span class="text-primary-500">Bug</span> logo on your
                                            website to link to the <strong>Lara</strong><span class="text-primary-500">Bug</span> website
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-2">
                                <h3 class="text-xl text-navy-500 pb-4">
                                    Dont's
                                </h3>
                                <div class="text-navy-500">
                                    <ul>
                                        <li><i class="far fa-times fa-fw text-red-500"></i> Do not merge the <strong>Lara</strong><span class="text-primary-500">Bug</span> logo
                                            into yours
                                        </li>
                                        <li><i class="far fa-times fa-fw text-red-500"></i> Do not sell the <strong>Lara</strong><span class="text-primary-500">Bug</span> logo
                                        </li>
                                        <li><i class="far fa-times fa-fw text-red-500"></i> Do not change the colors,
                                            proportions & typography
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-navy-500">
                        Please get in touch with us if you want to use branding which is not included on this page.
                    </p>
                </div>
                <div class="w-full md:w-1/3 p-6">
                    <div class="text-6xl text-center flex items-center justify-center text-navy-500 h-full">
                        <strong>Lara</strong><span class="text-primary-500">Bug</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-2 px-5">
                <a href="#" title="Download logos and banners"
                   class="bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-6 rounded-lg shadow-lg mx-auto mb-4">
                    Download logo's & banners kit
                </a>

                <small class="text-gray-500 mx-auto w-full text-center">By downloading you agree to the <a
                            href="{{ route('terms') }}" class="text-gray-700">terms of service</a> and terms stated
                    above.</small>
            </div>
        </article>
    </div>
@endsection
