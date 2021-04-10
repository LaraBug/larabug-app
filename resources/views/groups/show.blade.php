@extends('layouts.app')

@section('title', $group->title)

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-box">
                        <span class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('groups.edit', $group) }}">
                                Edit
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

                        <div class="row">
                            <div class="col-xs-12 col-6">
                                <table class="table">
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $group->title }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-xs-12 col-6">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;">Name</th>
                                        <th style="width: 15%;" class="text-center">Errors</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($group->projects as $project)
                                        <tr>
                                            <td>{{ $project->title }}</td>
                                            <td class="text-center">
                                                @if($project->exceptions->count())
                                                    <a href="{{ route('exceptions.index', $project) }}"
                                                    >
                                                        Errors <span
                                                                class="badge">{{ $project->exceptions->count() }}</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('exceptions.index', $project) }}"
                                                       class="btn btn-info btn-xs">
                                                        No unread errors
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-xs"
                                                   href="{{ route('projects.show', $project) }}">
                                                    Manage
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
