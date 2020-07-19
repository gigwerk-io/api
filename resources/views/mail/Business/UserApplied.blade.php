@component('mail::message')
    <h3>Hey There, </h3>
    <br>
    <p>{{ $user->first_name }} {{ $user->last_name }} applied to your business. Click on the button below to view her credentials.</p>
    <br>
    @component('mail::button', ['url' => $link, 'color' => 'success'])
        {{ $user->first_name }} {{ $user->last_name }}'s profile
    @endcomponent
    <br>
    <p>Thanks for using gigwerk!</p>
@endcomponent
