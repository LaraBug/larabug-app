@extends('layouts.app')

@section('title', 'Edit project ' . $project->title)

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')
        </h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content">
                        @include('errors.validation-errors')

                        {!! Form::model($project, ['class' => 'form-horizontal', 'method' => 'patch', 'route' => ['projects.update', $project], 'files' => true]) !!}
                        @include('projects.form')

                        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block mb-3']) !!}

                        {!! Form::close() !!}

                        @if(isset($project))
                            {!! Form::open(['route' => ['projects.test.webhook', $project], 'id' => 'webhook-test']) !!}

                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content">
                        {!! Form::open(['class' => 'mb-3', 'method' => 'delete', 'route' => ['projects.destroy', $project]]) !!}

                        <button class="btn btn-danger btn-block" type="button"
                                onclick="deleteEntity(this, 'project {{ $project->title }}')">
                            <i class="fa fa-trash fa-fw"></i>
                        </button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
