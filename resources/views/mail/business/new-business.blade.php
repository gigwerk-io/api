@component('mail::message')
    <h3>Hey {{ $user->first_name }}, </h3>
    <br>
    <p>Congratulations, you just created a new business, "{{ $business->name }}". Press on the button below to visit your dashboard.</p>
    <br>
    @component('mail::button', ['url' => $link, 'color' => 'success'])
        {{ $business->name }} dashboard
    @endcomponent
    <br>
    <p>Thanks for using gigwerk!</p>
@endcomponent
