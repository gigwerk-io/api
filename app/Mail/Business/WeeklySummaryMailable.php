<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WeeklySummaryMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $business;
    public $weeklyApplicants;
    public $weeklyJobsPosted;
    public $weeklyJobsCompleted;
    public $link;
    public $weeklyPayout;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $business, $weeklyApplicants, $WeeklyJobsPosted, $weeklyJobsCompleted, $weeklyPayout)
    {
        $this->user = $user;
        $this->business = $business;
        $this->weeklyApplicants = $weeklyApplicants;
        $this->weeklyJobsPosted = $WeeklyJobsPosted;
        $this->weeklyJobsCompleted = $weeklyJobsCompleted;
        $this->weeklyPayout = $weeklyPayout;
//        $this->link = route('stats', ['unique_id' => $business->unique_id]);
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\WeeklySummaryMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'Weekly business report!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.business.weekly-summary')->from($address, $name)
            ->subject($subject);
    }
}
