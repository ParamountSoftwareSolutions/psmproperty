@component('mail::message')
    Here is your reset password link {{ $mailData['name']}}. It's easy — just click the button below.
    @component('mail::button', ['url' => url($mailData['reset_link'])])
        Reset Password
    @endcomponent
    Thanks,

    {{ config('app.name') }}
@endcomponent

