@extends('layouts.app')

@section('title', 'Logbook')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('title')

                        <a class="btn btn-link btn-sm pull-right" href="{{ route('projects.show', $project) }}">
                            Back to project
                        </a>
                    </div>

                    <div class="panel-body">
                        <ol class="list-group">
                            @forelse ($audits as $audit)
                                <li class="list-group-item">
                                    {{ $audit->customMessage }}
                                    <ul>
                                        @forelse ($audit->customFields as $field => $custom)
                                            @if(!empty($audit->new[$field]) or !empty($audit->old[$field]))
                                                <li>{!! $custom !!}</li>
                                            @endif
                                        @empty
                                            <li>No details</li>
                                        @endforelse
                                        <li>{!! $audit->customFields['ip_address'] !!}</li>
                                    </ul>
                                </li>
                            @empty
                                <div class="alert alert-info">
                                    No log information available
                                </div>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
