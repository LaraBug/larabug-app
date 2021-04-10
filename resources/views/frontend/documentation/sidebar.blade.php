<aside class="col-span-3">
    <button id="js-docs-menu-toggle"
            class="bg-gray-100 mt-4 px-4 py-2 rounded text-sm font-medium inline-block | lg:hidden">
        Documentation menu
    </button>

    <script defer>
        document.querySelector('#js-docs-menu-toggle').addEventListener('click', () => {
            document.querySelector('#js-docs-menu').classList.toggle('hidden');
        })
    </script>

    <div id="js-docs-menu" class="py-2 h-full border-r hidden | lg:block">
        <p class="text-gray-600 py-2">Documentation</p>
        @foreach($categories as $category)
            <div class="py-2 pr-4">

                <p class="font-medium text-sm">{{ $category->title }}</p>

                <ul class="text-gray-600 pl-4 border-l-2">
                    @foreach($category->items as $item)
                        <li class="mt-2">
                            <a class="@if(request()->route('category') == $category->slug && request()->route('documentation') == $item->slug) text-primary-500 @endif" href="{{ route('docs.show', [$category->slug, $item->slug]) }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</aside>