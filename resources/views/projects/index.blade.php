@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="content projects">

        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> Projects

            {!! Form::model(request()->all(), ['class' => 'pull-right', 'method' => 'get']) !!}
            <div class="input-group mb-3">
                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search..']) !!}
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" id="button-addon2">
                        <i class="far fa-search"></i>
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </h2>

        @foreach($projects->chunk(4) as $chunked)
            <div class="row mb-3">
                @foreach($chunked as $project)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ $project->getProjectScreenshot() }}" alt="{{ $project->title }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $project->title }}
                                </h5>
                                <p class="card-text">
                                    {{ $project->description ?? '-No Description-' }}
                                </p>
                                <a href="{{ route('exceptions.index', $project->id) }}" class="btn btn-sm btn-primary">Exceptions ({{ $project->exceptions->count() }})</a>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-warning">Manage</a>
                                <a href="{{ $project->url }}" target="_blank" class="pull-right"><i class="far fa-external-link-alt"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
@endsection
