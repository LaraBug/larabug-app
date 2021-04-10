@extends('layouts.frontend')

@section('title', 'What is LaraBug?')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            <h1 class="title m-b-md">
                @yield('title')
            </h1>
            <hr />
        </div>

        <div class="col-xs-12 col-md-8 col-md-offset-2">

            <p>
                LaraBug will catch <strong>any</strong> error (exception) and save it to your created project.<br />
                This will allow you to overview all the errors (exceptions) that have been generated.
            </p>

            <p>
                You will need to require our <a href="https://github.com/Cannonb4ll/LaraBug" target="github2">github package</a> and include it in your project.<br />
                When you create a project in LaraBug, you will receive precise installation instructions to get you setup.<br />
                After that, you are ready to go.
            </p>

            <h2>How does it work?</h2>

            <p>
                Once your application generated an error, LaraBug's package will collect all important information (such as url, exception info, file, file line, logged user) and
                make a <code>cURL</code> request to our server to save the data.
                <br />
                It will use the provided <code>.env</code> variables to authorize with our server.
            </p>
        </div>
    </div>
@endsection
