<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class IncompleteAccountMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $paymentMethod;
    public $businessWorkers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $paymentMethod, $businessWorkers)
    {
        $this->user = $user;
        $this->paymentMethod = $paymentMethod;
        $this->businessWorkers = $businessWorkers;
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\IncompleteAccountMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'Complete your account setup!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.business.incomplete-account')->from($address, $name)
            ->subject($subject);
    }
}
