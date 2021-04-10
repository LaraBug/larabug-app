@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')
        </h2>

        @include('parts.success')
        <div class="row">
            <div class="col-6">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Overview</h4>
                        <div class="row">
                            <div class="col-12">
                                @include('errors.validation-errors')

                                {!! Form::model(auth()->user(), ['class' => 'form-horizontal', 'route' => 'profile.update', 'role' => 'form', 'method' => 'patch', 'files' => true]) !!}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Name</label>

                                    <div class="col-md-12">
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ ucfirst($errors->first('name')) }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">E-mail address</label>

                                    <div class="col-md-12">
                                        {!! Form::email('email', null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('locale') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Country</label>

                                    <div class="col-md-12">
                                        {!! Form::select('locale', countries(), null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('locale'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('locale') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <div class="col-md-10 col-md-offset-2">
                                        <label>
                                            {!! Form::hidden('receive_email', '0') !!}
                                            {!! Form::checkbox('receive_email', '1', null) !!} Always receive exception
                                            e-mails
                                        </label>
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <div class="col-md-10 col-md-offset-2">
                                        <label>
                                            {!! Form::hidden('newsletter', '0') !!}
                                            {!! Form::checkbox('newsletter', '1', null) !!} Receive newsletters
                                            e-mails
                                        </label>
                                    </div>
                                </div>

                                <hr/>

                                {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block mb-3']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Account details</h4>
                        <table class="table">
                            <tr>
                                <th>Authorization key</th>
                                <td>
                                    <code>{{ auth()->user()->api_token }}</code>
                                </td>
                            </tr>
                            <tr>
                                <th>Current package</th>
                                <td>
                                    {{ auth()->user()->plan->title }}
                                    @if(auth()->user()->plan_expires_at)
                                        (Expires at: {{ auth()->user()->plan_expires_at->format('Y-m-d') }})

                                        @if(auth()->user()->plan_expires_at->lt(carbon()))
                                            <span class="badge badge-warning">
                                                Expired
                                            </span>
                                        @endif
                                        <br/>


                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a class="btn btn-primary" href="{{ route('payment.checkout') }}">
                                        Upgrade/Extend <i class="far fa-sync"></i></a></td>
                                <td></td>
                            </tr>
                        </table>

                        @if(auth()->user()->plan->price == 0)
                            <a class="btn btn-primary btn-block mb-3" href="{{ route('payment.checkout') }}">Upgrade now <i
                                        class="fa fa-level-up"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="block">
                    <div class="block-content">
                        <h4 class="m-t-0 header-title">Settings</h4>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ url('https://www.gravatar.com') }}" target="gravatar">
                                    Change avatar
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('profile.newsletters') }}">
                                    Newsletters ({{ auth()->user()->newsletters->count() }})
                                </a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('profile.orders')}}">
                                    Orders
                                </a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('profile.social-accounts') }}">
                                    Social media accounts
                                </a>
                            </li>
                        </ul>

                        <div class="text-center mb-3 mt-3">
                            <img src="{{ auth()->user()->getGravatar(200) }}" class="rounded-circle"/>

                            <small class="text-muted">
                                Setup your avatar at <a href="https://www.gravatar.com" target="gravatar">gravatar.com</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.refresh-token')
@endsection
