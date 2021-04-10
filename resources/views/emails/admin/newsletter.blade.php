@component('mail::message')
# Hey {{ $user->first_name }},

{!! $content !!}

Best regards,<br>
{{ config('app.name') }}

<small>
    If you do not wish to receive these e-mails anymore, then you can opt-out in your LaraBug profile.
</small>
@endcomponent
