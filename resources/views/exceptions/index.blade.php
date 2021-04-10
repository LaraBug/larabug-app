@extends('layouts.app')

@section('title', 'Exceptions overview project '. $project->title)

@section('content')
    <exceptions :pagination="true" :data-exceptions="{{ json_encode($exceptions) }}" :project="{{ $project }}"></exceptions>
@endsection
