@component('mail::message')
<h3>Hello, </h3>
<br>
<p>We recieved a password reset request. Please click the button below to change your password.</p>
<br> 
@component('mail::button', ['url' => $link, 'color' => 'success'])
Reset Password
@endcomponent
<br>
<p>Thanks for using gigwerk!</p>
@endcomponent