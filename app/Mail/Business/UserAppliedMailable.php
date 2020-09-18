<?php

namespace App\Mail\Business;

use App\Contracts\Repositories\UserRepository;
use App\Models\Application;
use App\Models\Business;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAppliedMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $owner;

    /**
     * @var User
     */
    public $applicant;

    /**
     * Create a new message instance.
     * @param Business $business
     * @param Application $application
     */
    public function __construct(Business $business , Application $application)
    {
        $this->owner = $business->owner;
        $this->applicant = $application->load('user.profile');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.business.new-applicant')->subject('New Application');
    }
}
