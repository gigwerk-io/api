@component('mail::message')
    <h3>Hey {{ $owner->first_name }}, </h3>
    Your account setup is incomplete:
    <ul>
        <li>Please make sure to set up a payment method so you can start making money and growing your business.</li>
        <li>Don't forget to promote your business and find workers.</li>
        <li>Make sure to add marketplace jobs so you can get things done and draw in new workers.</li>
    </ul>
    @component('mail::button', ['url' => $link, 'color' => 'success'])
        <i>{{ $business->name }}</i> dashboard
    @endcomponent
    <p>Thanks for using gigwerk!</p>
@endcomponent
