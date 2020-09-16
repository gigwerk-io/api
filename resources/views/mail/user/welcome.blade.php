@component('mail::message')
    <h3>Hi {$user->name}, Welcome to Gigwerk! </h3>
    <br>
    <p>Before we can get started, we have to confirm your email address. Just click here:
    @component('mail::button')
        Confirm Email!
    @endcomponent
    </p>
    <br>
    <br>
    <p>Thanks for using Gigwerk!</p>
@endcomponent
