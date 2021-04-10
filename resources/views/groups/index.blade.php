@extends('layouts.app')

@section('title', 'Groups')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-box">
                        <span class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('groups.create') }}" >
                                Create group
                            </a>
                        </span>
                        <h4 class="page-title">@yield('title')</h4>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Overview</h4>

                        @include('parts.success')
                        @include('errors.validation-errors')

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 50%;">Name</th>
                                    <th>Projects</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->title }}
                                            @if($group->description)
                                                <br/>

                                                <small class="text-muted">
                                                    {{ $group->description }}
                                                </small>
                                            @endif

                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($group->projects as $project)
                                                    <li class="list-group-item">
                                                        <a href="{{ route('projects.show', $project) }}">
                                                            {{ $project->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-xs" href="{{ route('groups.show', $group) }}">
                                                Manage
                                            </a>

                                            @if(!$group->projects->count())
                                                {!! Form::open(['style' => 'display:inline;', 'method' => 'DELETE', 'route' => ['groups.destroy', $group]]) !!}
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                    Delete
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            {!! $groups->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
