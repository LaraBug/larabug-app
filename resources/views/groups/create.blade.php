@extends('layouts.app')

@section('title', 'Create group')

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

                        @include('errors.validation-errors')

                        {!! Form::open(['class' => 'form-horizontal', 'route' => 'groups.store']) !!}
                        @include('groups.form')

                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
