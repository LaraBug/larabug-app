@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="block block-rounded js-appear-enabled animated fadeIn mt-1" data-toggle="appear">
            <div class="block-content block-content-full">
                <div class="row text-center">
                    <div class="col-md-4 py-3 my-auto">
                        <div class="font-size-h1 font-w300 text-black mb-1">
                            {{ count($projects) }}
                        </div>
                        <a class="link-fx font-size-sm font-w700 text-uppercase text-muted"
                           href="{{ route('projects.index') }}">Projects</a>
                    </div>
                    <div class="col-md-4 py-3 my-auto">
                        <div class="font-size-h1 font-w300 text-success mb-1">
                            {{ number_format($totalExceptions, 0, ',', '.') }}
                        </div>
                        <a class="link-fx font-size-sm font-w700 text-uppercase text-muted" href="javascript:void(0)">Total
                            Exceptions</a>
                    </div>
                    <div class="col-md-4">
                        <chart
                                id="exceptionGrowth"
                                title="Exception Growth"
                                sub-title="Exceptions"
                                :height="175"
                                :labels="{{ $exceptionChart->keys() }}"
                                :values="{{ $exceptionChart->values() }}"
                        ></chart>
                    </div>
                </div>
            </div>
        </div>

        @if(!count($projects))
            <h2 class="content-heading">
                <i class="fa fa-angle-right text-muted mr-1"></i> Welcome to LaraBug
            </h2>

            <div class="alert alert-info">
                You do not have any projects yet, you can start by creating one in the sidebar under "Projects".
            </div>
        @elseif(!$exceptions->count())
            <h2 class="content-heading">
                <i class="fa fa-angle-right text-muted mr-1"></i> No latest exceptions 🐞
            </h2>
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <div class="block-content">
                            <chart
                                    id="exceptionGrowth2"
                                    title="Exception Growth"
                                    sub-title="Exceptions"
                                    :labels="{{ $exceptionChart->keys() }}"
                                    :values="{{ $exceptionChart->values() }}"
                            ></chart>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h2 class="content-heading">
                <i class="fa fa-angle-right text-muted mr-1"></i> Latest Exceptions
            </h2>

            @foreach($exceptions as $exception)
                <a class="block block-rounded block-link-shadow border-left border-info border-3x js-appear-enabled animated fadeIn"
                   data-toggle="appear" href="{{ $exception->route_url }}">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div>
                            <p class="font-size-lg font-w600 mb-0">
                                {{ str_limit($exception->exception, 100) }}
                            </p>
                            <p class="text-muted mb-0">
                                <strong>Class</strong> {{ $exception->class }}
                            </p>
                            <p class="text-muted mb-0">
                                <strong>File</strong> {{ $exception->file }} @ line {{ $exception->line }}
                            </p>
                        </div>
                        <div class="ml-3">
                            <i class="fa fa-arrow-left fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                    <span class="font-size-sm text-muted">Project <strong>{{ $exception->project->title }}</strong> at <strong>{{ $exception->created_at }}
                            ({{ $exception->human_date }})</strong></span>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
@endsection
