@extends('layouts.frontend')

@section('title', 'Contact')

@section('description', 'You can contact us here with basically anything, your life story, a bug or even just for a random talk.')

@section('content')
    <div id="top-content-small" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center rocket-animation-holder">
                    <div class="rocket-animation left">
                        <div class="rocket">
                            <img src="/images/question.png" width="136" height="190">
                            <span class="rocket-line rline1"></span>
                            <span class="rocket-line rline2"></span>
                            <span class="rocket-line rline3"></span>
                        </div>
                        <div class="cloud cloud1"><img src="{{ asset('images/cloud.png') }}" width="60" height="35">
                        </div>
                        <div class="cloud cloud2"><img src="{{ asset('images/cloud.png') }}" width="60" height="35">
                        </div>
                        <div class="cloud cloud3"><img src="{{ asset('images/cloud.png') }}" width="60" height="35">
                        </div>
                    </div>
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p>
                        You can contact us here with basically anything, your life story, a bug or even just for a
                        random talk.
                    </p>

                    @if(session('success'))
                        @include('parts.success')
                    @else

                        @include('errors.validation-errors')

                        {!! Form::open(['class' => 'form-horizontal']) !!}
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            <label class="col-xs-12">Name</label>
                            <div class="col-sm-12">
                                {!! Form::text('name', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <label class="col-xs-12">E-mail</label>
                            <div class="col-sm-12">
                                {!! Form::email('email', auth()->check() ? auth()->user()->email : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group @if($errors->has('content')) has-error @endif">
                            <label class="col-xs-12">Message</label>
                            <div class="col-sm-12">
                                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                <div class="col-sm-12">
                                    <div class="g-recaptcha"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::submit('Send', ['class' => 'btn btn-default']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table class="table">
                        <tr>
                            <td>support@larabug.com</td>
                        </tr>
                        <tr>
                            <td>Chamber of commerce: 57213429</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
