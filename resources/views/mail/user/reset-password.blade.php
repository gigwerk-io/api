@component('mail::message')
<h3>Hey {{ $user['name'] }}, </h3>
<br>
<p>We recieved a password reset request. Please click the button below to change your password.</p>
<br> 
<a class="btn btn-primary" href="{{ $link }}"></a>
<br>
<p>Thanks for using gigwerk!</p>
@endcomponent
