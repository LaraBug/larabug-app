
<footer class="py-16 bg-gray-900 text-white">
    <div class="w-full max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 gap-8 | lg:grid-cols-4 lg:gap-8">
            <article class="text-gray-400 leading-relaxed | lg:col-span-2">
                <p class="mb-2">
                    Registered company in The Netherlands under chamber of commerce number 57213429
                </p>
                <p class="mb-2">Proudly managed & deployed with <a class="text-primary-500" href="https://ploi.io" target="ploi">ploi.io</a></p>
                <p>
                    &copy; 2016 - {{ date('Y') }}
                </p>
            </article>
            <ul class="border-l-2 border-gray-800 pl-4 text-gray-400">
                <li class="font-medium text-primary-500 uppercase text-sm tracking-wider">Navigation</li>
                <li class="mt-1" title="Home">
                    <a href="/">Home</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('features') }}" title="Features">Features</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('pricing') }}" title="Pricing">Pricing</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('docs.show', ['general', 'welcome']) }}" title="Documentation">Docs</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('login') }}" title="Login">Login</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('register') }}" title="Get started" class="text-primary-500">Get started</a>
                </li>
            </ul>
            <ul class="border-l-2 border-gray-800 pl-4 text-gray-400">
                <li class="font-medium text-primary-500 uppercase text-sm tracking-wider">Information</li>
                <li class="mt-1">
                    <a href="{{ route('terms') }}" title="Terms of service">Terms of Service</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('privacy') }}" title="Privacy policy">Privacy Policy</a>
                </li>
                <li class="mt-1">
                    <a href="{{ route('branding') }}">Branding</a>
                </li>
                <li class="mt-1">
                    <a href="https://github.com/LaraBug" target="github">Github</a>
                </li>
                <li class="mt-1">
                    <a href="https://twitter.com/larabugEN" target="larabug-twitter">Twitter</a>
                </li>
                <li class="mt-1">
                    <a href="https://roadmap.larabug.com" target="roadmap">Roadmap</a>
                </li>
                <li class="mt-3 text-xs">
                    <a href="https://status.larabug.com" target="roadmap">
                        <i class="fas fa-circle text-green-500"></i> Service Status
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>