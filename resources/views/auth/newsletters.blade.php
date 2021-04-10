@extends('layouts.app')

@section('title', 'Newsletters')

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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->newsletters as $newsletter)
                                    <tr>
                                        <td>
                                            <a href="{{ route('profile.newsletter.show', $newsletter) }}">
                                                {{ $newsletter->subject }}
                                            </a>
                                        </td>
                                        <td>{{ $newsletter->created_at->format('Y-m-d') }}</td>
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
