@component('mail::message')
    <h3>Hey {{ $user->first_name }}, </h3>
    <br>
    <p>You have changed your subscription plan to {{ $subscriptionName }}. Press on the button below to view your new plan.</p>
    <br>
    @component('mail::button', ['url' => $link, 'color' => 'success'])
        Subscription plan
    @endcomponent
    <br>
    <p>Thanks for using gigwerk!</p>
@endcomponent
