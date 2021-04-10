@extends('layouts.app')

@section('title', 'Create project')

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')
        </h2>
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Overview</h4>

                        @if(auth()->user()->canCreateProjects($userProjectCount))
                            <div class="alert alert-info">
                                You have currently reached the max limit for your projects.<br/>
                                Please upgrade your account.
                            </div>

                            <a href="{{ route('payment.checkout') }}" class="btn btn-primary mb-3">
                                Upgrade my plan
                            </a>
                        @else

                            @include('errors.validation-errors')

                            {!! Form::open(['class' => 'form-horizontal', 'route' => 'projects.store']) !!}
                            @include('projects.form')

                            <p>
                                A new API key will be generated on creation. You will have to include this key into your
                                <code>.env</code> file to make your application communicate with larabug.com.<br/>
                                The installation manual will follow after creation.
                            </p>


                            {!! Form::submit('Save and show installation', ['class' => 'btn btn-primary btn-block mb-3']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
