@extends('layouts.app')

@section('title', 'Installation process')

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')
        </h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content">
                        <h3 style="margin-top: 5px;">Step 1 - Installation</h3>
                        <p>
                            Install the package in your project:<br/>

                            <code>composer require larabug/larabug</code>
                        </p>
                        <p>
                            After installing register the service provider in your <code>config/app.php</code>, <strong>make
                                sure this is the first provider in the</strong> <code>$providers = [];</code>
                            <strong>array:</strong><br/>
                            <code>LaraBug\ServiceProvider::class,</code>
                        </p>

                        <p>
                            Publish the config file:<br/>
                            <code>php artisan vendor:publish --provider="LaraBug\ServiceProvider"</code>
                        </p>

                        <hr/>
                        <h3 style="margin-top: 5px;">Step 2 - Usage</h3>
                        <p>
                            Open up the file <code>App\Exceptions\Handler.php</code> and add this code in the
                            <strong>report</strong> function:

                        <pre>
public function report(Exception $exception)
{
    if ($this->shouldReport($exception) && class_exists(\LaraBug\LaraBug::class)) {
        app('larabug')->handle($exception);
    }

    parent::report($exception);
}</pre>
                        </p>

                        <p>Now all that is left to do is to add the 2 <strong>enviroment variables</strong> to your .env
                            file:</p>

                        <pre>
LB_KEY={{ auth()->user()->api_token }}
LB_PROJECT_KEY={{ $project->key }}</pre>

                        <span class="text-muted">
                            Do not worry, you can get these keys at any time.
                        </span>

                        <hr/>

                        <p>
                            Test your errors by doing the following in a route or controller:<br/>

                            <code>throw new \Exception('Testing my application!');</code>
                        </p>

                        <hr/>

                        <h3 style="margin-top: 5px;">Step 3 - Finished!</h3>

                        <p>Thats it! You are all set to go!</p>

                        <small class="text-muted">
                            Don't be affraid to click this installation documentation away. You can always come back to this
                            document from your project panel.
                        </small>

                        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary btn-block mb-3">
                            Take me to my project overview
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
