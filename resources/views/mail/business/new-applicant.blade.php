@component('mail::message')
Hi, {{ $owner->name }}

You have received a new application to your business!
<br>
<br>
<img src="{{ $applicant->user->profile->image }}" alt="Profile Picture">
<br>
{{ $applicant->user->name }}

Please visit your business dashboard to respond to them! <br>

@component('mail::button', ['url' => ''])
To Dashboard
@endcomponent
@endcomponent
