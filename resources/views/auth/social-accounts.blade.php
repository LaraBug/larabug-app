@extends('layouts.app')

@section('title', 'Social accounts')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-box">
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

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 15%;">Provider</th>
                                    <th>ID</th>
                                    <th>Added on</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->socialUsersLatest as $social_user)
                                    <tr>
                                        <td class="text-center">
                                            @if($social_user->provider == 'ploi')
                                                <img src="https://ploi.io/images/ploi-logo-outline-small.png" width="32" />
                                            @else
                                                <i class="fab fa-{{ $social_user->provider }} fa-2x"></i>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $social_user->provider_id }}
                                        </td>
                                        <td>
                                            {{ $social_user->created_at->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['profile.social-accounts.delete', $social_user], 'method' => 'DELETE', 'style' => 'display: inline;']) !!}
                                            <button class="btn btn-sm btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
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
@endsection
