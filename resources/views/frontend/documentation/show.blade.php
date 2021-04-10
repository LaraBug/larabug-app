@extends('layouts.frontend')

@section('title', $item->title)

@section('content')
    <div class="w-full max-w-6xl mx-auto px-4 | lg:grid lg:grid-cols-12 lg:gap-8">
        @include('frontend.documentation.sidebar')

        <section class="col-span-9">
            <div class="markdown">
                {{ Markdown::parse($item->content ?? '') }}
            </div>

{{--            <div class="grid grid-cols-2 gap-2 border-t py-4 -mx-4 px-4 | lg:-mx-8 lg:px-8">--}}
{{--                <a href="#" class="flex flex-col items-start">--}}
{{--                    <span class="text-gray-600">Previous</span>--}}
{{--                    <span class="font-medium text-xl text-primary-500">Welcome</span>--}}
{{--                </a>--}}
{{--                <a href="#" class="flex flex-col items-end">--}}
{{--                    <span class="text-gray-600">Next</span>--}}
{{--                    <span class="font-medium text-xl text-primary-500">Errors</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </section>
    </div>
@endsection