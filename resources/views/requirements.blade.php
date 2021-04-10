@extends('layouts.frontend')

@section('title', 'Requirements')

@section('description', 'The requirements for LaraBug.')

@section('content')
    <div id="top-content-small" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center rocket-animation-holder">
                    <div class="rocket-animation">
                        <div class="rocket">
                            <img src="images/rocket.png" width="136" height="190">
                            <span class="rocket-line rline1"></span>
                            <span class="rocket-line rline2"></span>
                            <span class="rocket-line rline3"></span>
                        </div>
                        <div class="cloud cloud1"><img src="images/cloud.png" width="60" height="35"></div>
                        <div class="cloud cloud2"><img src="images/cloud.png" width="60" height="35"></div>
                        <div class="cloud cloud3"><img src="images/cloud.png" width="60" height="35"></div>
                    </div>
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="requirements" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">

                    <p>These are the recommended requirements for LaraBug.</p>
                    <p>
                    <ul class="list-group">
                        <li class="list-group-item">Laravel version 5.1 or higher</li>
                        <li class="list-group-item">PHP 5.6+</li>
                        <li class="list-group-item">Web server with internet connection</li>
                    </ul>
                    </p>

                    <p>
                        Installation is fairly simple and our panel gives installation instructions when you create a
                        project.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
