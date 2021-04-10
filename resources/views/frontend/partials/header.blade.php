<!-- Desktop menu -->
<header class="w-full hidden | lg:block">
    <div class="w-full max-w-6xl mx-auto px-4">
        <div class="h-20 flex justify-start items-center border-b">
            <a href="/" class="text-2xl tracking-tighter flex mr-auto">
                <span class="font-medium">Lara</span>
                <span class="text-primary-500">Bug</span>
            </a>
            <nav class="flex h-full items-center text-gray-600">
                <a class="mr-8 @if(request()->is('/')) text-primary-500 @endif" href="/">Home</a>
                <a class="mr-8 @if(request()->is('features')) text-primary-500 @endif" href="{{ route('features') }}">Features</a>
                <a class="mr-8 @if(request()->is('pricing')) text-primary-500 @endif" href="{{ route('pricing') }}">Pricing</a>
                <a class="mr-8 @if(request()->is('docs*')) text-primary-500 @endif" href="{{ route('docs.show', ['general', 'welcome']) }}">Docs</a>
                @guest
                    <a class="mr-8 @if(request()->is('login')) text-primary-500 @endif" href="{{ route('login') }}">Login</a>
                @endguest

                @auth
                    <a class="mr-8 text-primary-500 align-middle" href="{{ route('panel.dashboard') }}">
                        <img class="inline rounded-full mr-1" src="{{ auth()->user()->getGravatar(32) }}"/> Dashboard
                    </a>
                @endauth
            </nav>
            @guest
                <a href="{{ route('register') }}"
                   class="flex-shrink-0 rounded shadow font-medium tracking-wider h-10 text-sm px-4 text-white inline-flex justify-center items-center text-center bg-primary-500 border border-primary-500 | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    Start
                </a>
            @endguest
        </div>
    </div>
</header>

<!-- Mobile menu -->
<header class="shadow | lg:hidden">
    <div class="flex justify-start items-center h-16 px-4">
        <a href="/" class="text-2xl tracking-tighter flex mr-auto">
            <span class="font-medium">Lara</span>
            <span class="text-primary-500">Bug</span>
        </a>
        <button class="uppercase tracking-wider font-medium" id="js-mobile-menu-toggle">Menu</button>
    </div>
    <nav class="w-full p-4 border-t-2 border-gray-100 hidden" id="js-mobile-menu">
        <span class="text-gray-600 p-4 w-full h-12 flex justify-start items-center">Navigation</span>
        <a class="p-4 w-full h-12 flex justify-start items-center  @if(request()->is('/')) bg-primary-200 text-primary-600 rounded @endif"
           href="/">Home</a>
        <a class="p-4 w-full h-12 flex justify-start items-center @if(request()->is('features')) bg-primary-200 text-primary-600 rounded @endif" href="{{ route('features') }}">Features</a>
        <a class="p-4 w-full h-12 flex justify-start items-center @if(request()->is('pricing')) bg-primary-200 text-primary-600 rounded @endif" href="{{ route('pricing') }}">Pricing</a>
        <a class="p-4 w-full h-12 flex justify-start items-center @if(request()->is('docs*')) text-primary-500 @endif" href="{{ route('docs.show', ['general', 'welcome']) }}">Docs</a>
        @guest
            <a class="p-4 w-full h-12 flex justify-start items-center @if(request()->is('login')) text-primary-500 @endif" href="{{ route('login') }}">Login</a>
        @endguest

        @auth
            <a class="p-4 w-full h-12 flex justify-start items-center" href="{{ route('panel.dashboard') }}">
                <img class="inline rounded-full mr-1" src="{{ auth()->user()->getGravatar(32) }}"/> Dashboard
            </a>
        @endauth
    </nav>
</header>

<script defer>
    document.querySelector('#js-mobile-menu-toggle').addEventListener('click', () => {
        document.querySelector('#js-mobile-menu').classList.toggle('hidden');
    })
</script>