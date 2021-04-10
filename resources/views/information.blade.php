@extends('layouts.frontend')

@section('title', 'Information')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            <h1 class="title m-b-md">
                @yield('title')
            </h1>

            <p>
                LaraBug has been brought to life to give insights in errors in your application.<br/>
                You will be able to view all errors that have occurred when customers/users use your website.<br /><br />

                View the <a href="{{ route('page.features') }}">features</a> page to see what LaraBug actually can do.
            </p>
        </div>
    </div>
@endsection
