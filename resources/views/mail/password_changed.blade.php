@component('mail::message')
    Hi {{ $mailData['name']}} Your password is successfully changed. If you have not changed it please contact with administrator as soon as possible.
    Thanks,

    {{ config('app.name') }}
@endcomponent

