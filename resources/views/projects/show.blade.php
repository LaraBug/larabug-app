@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')
        </h2>

        @include('parts.success')
        <div class="row">
            <div class="col-8">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Overview</h4>
                        @include('errors.validation-errors')

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $project->title }}</td>
                                </tr>
                                <tr>
                                    <th>Application URL</th>
                                    <td>{!! $project->url ? '<a href="' . $project->url . '" target="'. $project->title .'">' . $project->url . '</a>' : '- No url provided -' !!}</td>
                                </tr>
                                @if(auth()->user()->canManageGroups())
                                    <tr>
                                        <th>Project group</th>
                                        <td>{{ $project->group->title ?? '-No group attached-' }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>API key</th>
                                    <td><code>{{ $project->key }}</code></td>
                                </tr>
                                <tr>
                                    <th>Total exceptions</th>
                                    <td>{{ $project->total_exceptions }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $project->description ? $project->description : '- No description provided -' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Overview</h4>
                        @if(!auth()->user()->plan->isDefaultPlan() && $project->getDefaultImage('thumb'))
                            <div class="row text-center">
                                <img src="{{ $project->getDefaultImage('thumb') }}" style="max-width: 50%;"/>
                                <hr/>
                            </div>
                        @endif

                        <ul class="list-group mb-3">
                            <li class="list-group-item">
                                <a href="{{ route('exceptions.index', $project) }}">
                                    Exceptions ({{ $project->exceptions()->new()->count() }})
                                </a>
                            </li>
                            @if($project->isOwner())
                                <li class="list-group-item">
                                    <a href="{{ route('projects.edit', $project) }}">
                                        Edit project details
                                    </a>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <a href="{{ route('projects.installation', $project) }}">
                                    Show installation manual
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
