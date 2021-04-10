@extends('layouts.app')

@section('title', 'Orders')

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
                                    <th class="text-center" style="width: 15%;">Order #</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->ordersLatest as $order)
                                    <tr>
                                        <td class="text-center">
                                            #{{ $order->id }}
                                        </td>
                                        <td>{{ $order->description }}</td>
                                        <td>{{ $order->success ? 'Paid' : 'Not paid' }}</td>
                                        <td>{{ money($order->amount) }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
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
