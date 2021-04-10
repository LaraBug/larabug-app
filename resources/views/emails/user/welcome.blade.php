@component('mail::message')
# Hey {{ $user->first_name }} 👋

Thank you for signing up!

LaraBug is **free** to use, it is supported by the community via GitHub sponsors. Please consider sponsoring to keep the project
going!

@component('mail::button', ['url' => 'https://github.com/sponsors/Cannonb4ll', 'color' => 'red'])
    Sponsor LaraBug
@endcomponent

You will now be able to create projects, and install the package to your project you want to log errors from.

@component('mail::button', ['url' => route('panel.projects.create'), 'color' => 'primary'])
    Create your first project
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent
