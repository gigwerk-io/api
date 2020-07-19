@component('mail::message')
    <h3>Hey {{ $user->first_name }}, </h3>
    <br>
    <p>Your account setup is incomplete. {{ $message }}</p>
    <br>
    <p>Thanks for using gigwerk!</p>
@endcomponent
