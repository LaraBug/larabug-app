@extends('layouts.frontend')

@section('title', $exception->exception)

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    <div class="pt-8 overflow-hidden mb-8">
        <article class="w-full max-w-6xl mx-auto px-4 mb-4">
            <h1 class="text-3xl leading-tight tracking-tighter font-medium mb-4">
                {{ $exception->exception }}
            </h1>

            <table class="w-full text-left">
                <tr>
                    <th class="px-4 py-2">Method</th>
                    <td class="px-4 py-2">{{ $exception->method }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2">Reported</th>
                    <td class="px-4 py-2">{{ $exception->created_at }} ({{ $exception->human_date }})</td>
                </tr>
                @if($exception->occurences_count)
                    <tr>
                        <th class="px-4 py-2">Other occurences</th>
                        <td class="px-4 py-2">{{ $exception->occurences_count }} total occurence(s) within 1 month</td>
                    </tr>
                @endif
                <tr>
                    <th class="px-4 py-2">File</th>
                    <td class="px-4 py-2">{{ $exception->file }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2">Line</th>
                    <td class="px-4 py-2">{{ $exception->line }}</td>
                </tr>
            </table>
        </article>

        <article class="w-full max-w-6xl mx-auto px-4 text-center">
            <pre class="{{ $exception->markup_language }} line-numbers"
                 data-start="{{ $exception->executor[0]['line_number'] }}"
                 data-line="{{ $exception->line }}"><code>{{ $exception->executor_output }}</code></pre>
        </article>
    </div>
@endsection
