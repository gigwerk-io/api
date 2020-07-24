<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class IncompleteSetupMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\IncompleteSetupMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'Complete your account setup!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.Business.IncompleteAccount')->from($address, $name)
            ->subject($subject);
    }
}
