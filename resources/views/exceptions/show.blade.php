@extends('layouts.app')

@section('title', 'View exception - ' . $exception->created_at->diffForHumans() . ' (' . $exception->created_at .')')

@push('css')
    <style>
        pre {
            white-space: pre-wrap; /* Since CSS 2.1 */
            white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word; /* Internet Explorer 5.5+ */
        }

        .exception-currentline {
            color: #aaaaaa;
        }

        .exception-keyword {
            color: #862319;
            font-weight: 800;
        }

        .exception-var {
            color: #c73425;
        }

        .exception-string {
            color: #CC9385;
        }
    </style>
@endpush

@section('content')
    <div class="content">
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> @yield('title')

            <div class="pull-right">
                <a href="{{ route('exceptions.index', $project) }}" class="btn btn-primary">
                    Back to exceptions
                </a>

                <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">
                    Project {{ $project->title }}
                </a>
            </div>
        </h2>

        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-content">
                        @include('parts.success')

                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#exception" role="tab" aria-controls="home" aria-selected="true">Exception</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#user" role="tab" aria-controls="profile" aria-selected="false">User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#options" role="tab" aria-controls="contact" aria-selected="false">Options</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane show active" id="exception" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Exception:</th>
                                                <td>{{ $exception->exception }}</td>
                                            </tr>
                                            <tr>
                                                <th>Method:</th>
                                                <td>{{ $exception->method }}</td>
                                            </tr>
                                            <tr>
                                                <th>URL:</th>
                                                <td>{{ $exception->fullUrl }}</td>
                                            </tr>
                                            <tr>
                                                <th>File:</th>
                                                <td>{{ $exception->file }}</td>
                                            </tr>
                                            <tr>
                                                <th>Class:</th>
                                                <td>{{ $exception->class }}</td>
                                            </tr>
                                            <tr>
                                                <th>Line:</th>
                                                <td>{{ $exception->line }}</td>
                                            </tr>
                                            @if(count($exception->executor))
                                                <tr>
                                                    <td colspan="2">
<pre style="margin: 0 0 0 0; padding: 5px 12px; white-space: pre-wrap; word-break: break-word;">
@foreach($exception->executor as $lineInfo)
{!! $lineInfo['wrap_left'] !!}{!! $lineInfo['line'] !!}{!! $lineInfo['wrap_right'] !!}
@endforeach
</pre>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2">
                                                    <h4>Stack trace:</h4>
                                                    <pre>{!! Highlight::process($exception->error) !!}</pre>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="user" role="tabpanel" aria-labelledby="profile-tab">
                                    @if($exception->user)
                                        <div class="table-responsive">
                                            <table class="table">
                                                @foreach($exception->user as $key => $user)
                                                    <tr>
                                                        <th>{{ $key }}:</th>
                                                        <td>
                                                            @if(is_array($user))
                                                                @foreach($user as $extra)
                                                                    @if(is_array($extra))
                                                                        {{ serialize($extra) }}
                                                                    @else
                                                                        &nbsp; - {{ $extra }}<br/>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                {{ $user }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @else
                                        <br/>
                                        <div class="alert alert-info">
                                            No user information available
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="options" role="tabpanel" aria-labelledby="contact-tab">
                                    @if($exception->isPublic())
                                        <h3 class="mt-2">Public exception data:</h3>
                                        <table class="table">
                                            <tr>
                                                <th>Published at</th>
                                                <td>{{ $exception->published_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publish URL</th>
                                                <td>{!! Form::text('url', route('public.exception', $exception->publish_hash), ['class' => 'form-control']) !!}</td>
                                            </tr>

                                            <tr>
                                                <th>Unpublish</th>
                                                <td>
                                                    {!! Form::open(['route' => ['exceptions.public.remove', $project, $exception]]) !!}
                                                    {!! Form::submit('Remove public', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        </table>
                                    @else
                                        <h3 class="mt-2">Make a public URL for this exception:</h3>

                                        <p>You can publish this exception with a unique URL for you to share with other
                                            people.<br/>
                                            This way you will have a great experience showing other people your
                                            exception, which they might off assist you on.</p>

                                        <p>
                                            Due to privacy reasons, we tell the search engine bot's <strong>not</strong>
                                            to index this public exception page.<br/>
                                            So this exception will not get indexed by search engines like Google or
                                            Yahoo.
                                        </p>

                                        {!! Form::open(['route' => ['exceptions.public', $project, $exception]]) !!}
                                        {!! Form::submit('Generate URL', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    <hr/>

                                    <h3>
                                        I want to disable this class from being logged:
                                    </h3>

                                    <p>There are 2 ways to prevent this exception from beeing logged:</p>

                                    <ol>
                                        <li>Add this class file (<code>{{ $exception->class }}</code>) to your <code>$dontReport</code>
                                            array inside the <code>App\Exceptions\Handler.php</code> file.
                                        </li>
                                        <li>
                                            Or you can add this class to your <code>app/larabug.php</code> file inside the
                                            <code>except
                                                array:</code><br/>
                                            <code>{{ $exception->class }}</code>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
