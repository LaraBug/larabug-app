<section class="py-16 | lg:py-32">
    <div class="w-full max-w-6xl mx-auto px-4">
        <div class="grid gap-8 items-center | lg:grid-cols-2 lg:gap-16">
            <article>
                <h2 class="text-3xl leading-tight tracking-tighter font-medium | lg:md-4xl" id="track-and-fix-errors">
                    Track and fix errors @include('frontend.partials.hashtag-link', ['id' => 'track-and-fix-errors'])
                </h2>
                <p class="mt-2 text-gray-600 | lg:text-lg">
                    Get up and running within 2 minutes.
                </p>
                <p class="mt-4 text-lg | lg:text-xl">
                    LaraBug tracks all types of errors your application generates.
                </p>
                <a title="Start your 5-day free trial" href="{{ route('register') }}" class="mt-4 flex-shrink-0 rounded shadow text-white font-medium tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
            | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    Get started
                </a>
            </article>
            <div class="relative w-full rounded overflow-hidden bg-gray-200 shadow-xl select-none pointer-events-none transform-feature-r">
                <div id="exceptions" class="p-4 grid gap-4">
                    <dl class="rounded shadow bg-white p-4 grid grid-cols-2 gap-4">
                        <dt class="font-medium">Exception</dt>
                        <dd class="text-red-600 font-medium truncate">Object of class stdClass could not be converted to string</dd>
                        <dt class="font-medium">url</dt>
                        <dd class="text-gray-600">/invoices/update</dd>
                        <dt class="font-medium">Method</dt>
                        <dd class="text-gray-600">PATCH</dd>
                        <dt class="font-medium">Class</dt>
                        <dd class="text-gray-600 truncate">InvoiceController</dd>
                        <dt class="font-medium">Reported</dt>
                        <dd class="text-gray-600 truncate">2020-02-16 08:51:21 (24 seconds ago)</dd>
                    </dl>
                    <dl class="rounded shadow bg-white p-4 grid grid-cols-2 gap-4">
                        <dt class="font-medium">Exception</dt>
                        <dd class="text-red-600 font-medium truncate">Notice: Trying to get property of non-object</dd>
                        <dt class="font-medium">url</dt>
                        <dd class="text-gray-600">/home</dd>
                        <dt class="font-medium">Method</dt>
                        <dd class="text-gray-600">GET</dd>
                        <dt class="font-medium">Class</dt>
                        <dd class="text-gray-600 truncate">HomeController</dd>
                        <dt class="font-medium">Reported</dt>
                        <dd class="text-gray-600 truncate">2020-02-16 08:51:21 (24 seconds ago)</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-100 | lg:py-32">
    <div class="w-full max-w-6xl mx-auto px-4">
        <div class="grid gap-8 items-center | lg:grid-cols-2 lg:gap-16">
            <div
                    class="relative w-full rounded overflow-hidden bg-gray-200 shadow-xl select-none pointer-events-none transform-feature-l">
                <div class="animation-share-modal absolute inset-0 w-full h-full bg-white z-40 p-8">
                    <div class="animation-stagger text-red-600 text-xl leading-tight font-medium">Illegal value</div>
                    <dl class="grid grid-cols-2 gap-4 mt-4">
                        <dt class="animation-stagger font-medium">Other occurences</dt>
                        <dt class="animation-stagger text-gray-600">1 this month</dt>
                        <dt class="animation-stagger font-medium">File</dt>
                        <dt class="animation-stagger text-gray-600 truncate">
                            /home/ploi/website.com/index.php</dt>
                        <dt class="animation-stagger font-medium">Line</dt>
                        <dt class="animation-stagger text-gray-600 truncate">3</dt>
                    </dl>
                    <pre class="animation-stagger bg-gray-900 p-4 mt-4 -mx-4 rounded language-php" data-start="0" data-line="3">
                <code class="text-white font-mono">
public function show(): Exception {
  throw new Exception('
    This is a test exception
    from the LaraBug console
  ');
}</code>
              </pre>
                </div>
                <div class="p-4 grid gap-4">
                    <div class="animation-share-card rounded shadow bg-white p-4">
                        <dl class="grid grid-cols-2 gap-4">
                            <dt class="font-medium">Exception</dt>
                            <dd class="text-red-600 font-medium">Illegal value</dd>
                            <dt class="font-medium">Other occurences</dt>
                            <dt class="text-gray-600">None</dt>
                            <dt class="font-medium">Visibility</dt>
                            <dt class="text-gray-600">Private</dt>
                        </dl>
                        <button
                                class="animation-share-button mt-4 px-4 py-2 font-medium tracking-wide rounded shadow bg-green-600 text-white">
                            Share error
                        </button>
                    </div>
                    <div class="animation-share-card rounded shadow bg-white p-4">
                        <dl class="grid grid-cols-2 gap-4">
                            <dt class="font-medium">Exception</dt>
                            <dd class="text-red-600 font-medium">Illegal value</dd>
                            <dt class="font-medium">Other occurences</dt>
                            <dt class="text-gray-600">1 this month</dt>
                            <dt class="font-medium">Visibility</dt>
                            <dt class="text-gray-600">Public</dt>
                        </dl>
                        <button class="mt-4 px-4 py-2 font-medium tracking-wide rounded bg-gray-200 text-gray-900">
                            Make private
                        </button>
                    </div>
                </div>
            </div>
            <article>
                <h2 class="text-3xl leading-tight tracking-tighter font-medium | lg:md-4xl" id="sharing-exceptions">
                    Sharing exceptions @include('frontend.partials.hashtag-link', ['id' => 'sharing-exceptions'])
                </h2>
                <p class="mt-2 text-gray-600 | lg:text-lg">
                    Collaborate with others
                </p>
                <p class="mt-4 text-lg | lg:text-xl">
                    You can safely share your exceptions to collaborate on solutions. This makes solving errors easy.
                </p>
                <a title="Start your 5-day free trial" href="{{ route('register') }}" class="mt-4 flex-shrink-0 rounded text-white shadow font-medium tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
            | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    Get started
                </a>
            </article>
        </div>
    </div>
</section>

<section class="py-16 | lg:py-32">
    <div class="w-full max-w-6xl mx-auto px-4">
        <div class="grid gap-8 items-center | lg:grid-cols-2 lg:gap-16">
            <article>
                <h2 class="text-3xl leading-tight tracking-tighter font-medium | lg:md-4xl" id="feedback">
                    Feedback @include('frontend.partials.hashtag-link', ['id' => 'feedback'])
                </h2>
                <p class="mt-2 text-gray-600 | lg:text-lg">
                    Collect feedback when a user experiences an exception
                </p>
                <p class="mt-4 text-lg | lg:text-xl">
                    Sometimes it is useful to know the flow of how an exception occured. With our easy feedback feature, it is possible for your users to leave feedback on how the error happened.
                </p>
                <a title="Start your 5-day free trial" href="{{ route('register') }}" class="mt-4 flex-shrink-0 rounded shadow text-white font-medium tracking-wider h-12 px-6 inline-flex justify-center items-center text-center bg-primary-500
            | focus:outline-none focus:shadow-outline focus:border-primary-600 | hover:bg-primary-400">
                    Get started
                </a>
            </article>
            <div
                    class="relative w-full rounded overflow-hidden bg-gray-200 shadow-xl select-none pointer-events-none transform-feature-r"
                    style="padding-top: 85%">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="p-4 h-full">
                        <div class="h-full flex justify-center items-center flex-col">
                            <div class="text-lg leading-tight font-medium mb-4">Oops, something went wrong..</div>
                            <button
                                    class="animation-feedback-button px-4 py-2 font-medium tracking-wide rounded shadow bg-green-600 text-white">
                                Share feedback
                            </button>
                        </div>

                        <div class="animation-feedback-modal absolute inset-x-0 top-0 p-4">
                            <div class="rounded overflow-hidden shadow bg-white p-4">
                                <div class="animation-stagger text-lg leading-tight font-medium">Oops, something went wrong...</div>
                                <div class="animation-stagger mb-4 mt-1 text-gray-600">Don't worry, we can fix it with your feedback
                                </div>
                                <div class="animation-stagger mb-4">
                                    <div class="text-sm tracking-wide text-gray-600 mb-1">Name</div>
                                    <div class="w-full p-2 border rounded">John Doe</div>
                                </div>
                                <div class="animation-stagger mb-4">
                                    <div class="text-sm tracking-wide text-gray-600 mb-1">Email address</div>
                                    <div class="w-full p-2 border rounded">john@doe.com</div>
                                </div>
                                <div class="animation-stagger mb-4">
                                    <div class="text-sm tracking-wide text-gray-600 mb-1">What happend?</div>
                                    <div class="w-full p-2 border rounded">I clicked the save button which made it explode 🧨</div>
                                </div>
                                <button
                                        class="animation-stagger animation-feedback-modal-button px-4 py-2 font-medium tracking-wide rounded shadow bg-green-600 text-white">
                                    Share feedback
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>