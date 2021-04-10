@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">2FA Secret Key</div>

                    <div class="panel-body">
                        Open up your 2FA mobile app and scan the following QR barcode:
                        <br />
                        <img alt="Image of QR barcode" src="{{ $image }}" />

                        <br />
                        If your 2FA mobile app does not support QR barcodes,
                        enter in the following number: <code>{{ $secret }}</code>
                        <br /><br />

                        {!! Form::open(['action' => 'Google2FAController@enable']) !!}
                        <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                            {!! Form::label('key', 'Key', ['class' => 'control-label']) !!}
                            {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => '120124', 'autofocus']) !!}
                            @if ($errors->has('key'))
                                <span class="help-block">
                                <strong>{{ $errors->first('key') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection