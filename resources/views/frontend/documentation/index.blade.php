@extends('layouts.frontend')

@section('title', 'Documentation')

@section('content')
    <div class="w-full max-w-6xl mx-auto px-4 | lg:grid lg:grid-cols-12 lg:gap-8">
        @include('frontend.documentation.sidebar')

        <section class="col-span-9">
            <div class="markdown">
                <h1 class="my-8 text-3xl font-medium leading-tight">Welcome</h1>

                <p class="my-8 leading-relaxed">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia velit autem
                    dolorem ipsum sapiente iusto consectetur <a class="text-primary-600 border-b-2 border-primary-200"
                                                                href="#">laboriosam</a> animi facere vero.
                    Commodi, <b class="font-medium">veritatis</b> sit ex quae atque maxime amet. Illum, maxime.
                </p>

                <p class="my-8 leading-relaxed">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste assumenda officia beatae,
                    sapiente, illum eos unde aliquid minima laboriosam odit dolorem, neque cum obcaecati natus
                    delectus sit non. Repellendus iusto maxime cumque non asperiores et accusantium amet placeat
                    eum minima pariatur quae numquam perspiciatis doloribus quam molestias, autem eos, ut,
                    recusandae laborum commodi necessitatibus repudiandae reprehenderit at. Rerum cum consequuntur,
                    sapiente ratione laborum amet sequi, distinctio provident beatae incidunt molestias quaerat
                    vitae molestiae, facilis harum. Debitis ab odio non distinctio fugit molestiae ea!
                </p>

                <h2 class="text-2xl font-medium leading-tight">Comparison</h2>

                <p class="my-8 leading-relaxed">
                    Tenetur
                    recusandae incidunt veniam explicabo debitis a quod nemo tempore consequatur harum fugiat
                    iste iure, vero omnis cupiditate laboriosam deserunt porro nihil itaque! Praesentium doloremque
                    nostrum ut maxime. Magni, ab libero debitis aliquid similique incidunt, maxime, consequatur cumque
                    ut minus.
                </p>

            </div>

            <div class="grid grid-cols-2 gap-2 border-t py-4 -mx-4 px-4 | lg:-mx-8 lg:px-8">
                <a href="#" class="flex flex-col items-start">
                    <span class="text-gray-600">Previous</span>
                    <span class="font-medium text-xl text-primary-500">Welcome</span>
                </a>
                <a href="#" class="flex flex-col items-end">
                    <span class="text-gray-600">Next</span>
                    <span class="font-medium text-xl text-primary-500">Errors</span>
                </a>
            </div>
        </section>
    </div>
@endsection