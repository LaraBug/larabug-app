@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">2FA Secret Key</div>

                    <div class="panel-body">
                        @if(auth()->user()->google2fa_secret)
                            <p>Already enabled 2fa</p>

                            {!! Form::open(['action' => 'Google2FAController@disable']) !!}
                            <button type="submit" class="btn btn-danger">Disable 2FA</button>
                            {!! Form::close() !!}
                        @else
                            <p>
                                Two-factor authentication, or 2FA, is a way of logging into websites that requires more
                                than just a password.
                                Using a password to log into a website is susceptible to security threats, because it
                                represents a single piece of information a malicious person needs to acquire.
                                The added security that 2FA provides is requiring additional information to sign in.
                            </p>
                            <p>
                                In {{ config('app.name') }} its case, this additional information is an authentication code that's
                                generated by an application on your smartphone.
                                After 2FA is enabled, {{ config('app.name') }} generates an authentication code any time someone
                                attempts to sign into your {{ config('app.name') }} account.
                                The only way someone can sign into your account is if they know both your password and
                                have access to the authentication code on your phone.
                            </p>
                            <p>
                                We strongly urge you to turn on 2FA for the safety of your account, not only
                                on {{ config('app.name') }}, but on every websites that support it.
                            </p>

                            <hr/>

                            <a href="{{ route('2fa.enable') }}" class="btn btn-primary">Enable 2FA</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection