@component('mail::message')
<h3>Hey {{ $user->first_name }}, </h3>
<br>
<p>This is a weekly business report for "{{ $business->name }}". Here are a few stats about your business:</p>
<ul>
    <li><b>Applicants this week -</b> {{ $weeklyApplicants }}</li>
    <li><b>Total jobs posted this week -</b> {{ $weeklyJobsPosted }}</li>
    <li><b>Jobs Completed this week -</b> {{ $weeklyJobsCompleted }}</li>
    <li><b>Weekly payout -</b> ${{ $weeklyPayout }}</li>
</ul>
<p>Find out more about "computers" on your business dashboard...</p>
@component('mail::button', ['url' => $link, 'color' => 'success'])
Business dashboard
@endcomponent
<br>
<p>Thanks for using Gigwerk!</p>
@endcomponent
