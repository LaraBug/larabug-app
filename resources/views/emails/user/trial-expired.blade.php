@component('mail::message')
# Hey {{ $user->first_name }},

Your trial on LaraBug has expired! 😩 We hope you had an good experience with LaraBug.
If there is anything you did not like or any suggestions, drop in at our livechat!

@component('mail::button', ['url' => route('panel.billing.show'), 'color' => 'primary'])
    Renew My Subscription
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent
