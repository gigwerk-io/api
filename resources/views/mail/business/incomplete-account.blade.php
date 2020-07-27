@component('mail::message')
    <h3>Hey {{ $user->first_name }}, </h3>
    <br>
    <p>Your account setup is incomplete.</p>
    @if (is_null($paymentMethod) && is_null($businessWorkers))
        <p>Don't forget to promote your business, you currently have no workers.
        Please make sure to set up a payment method so you can start a business, start working,
        and request jobs. Simply navigate to your settings, select the add payment method option,
        and enter your credentials.</p>
    @endif

    @if (is_null($paymentMethod) && !is_null($businessWorkers))
        <p>Please make sure to set up a payment method so you can start a business,
        start working, and request jobs.</p>
    @endif

    @if (!is_null($paymentMethod) && is_null($businessWorkers))
        <p>Don't forget to promote your business, you currently have no workers.</p>
    @endif
    <br>
    <p>Thanks for using gigwerk!</p>
@endcomponent
