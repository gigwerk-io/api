<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserAppliedMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $business)
    {
        $this->link = route('show.applicant', ['unique_id' => $business, 'id' => $user->id]);
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\UserAppliedMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'Someone applied to your business!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.Business.UserApplied')->from($address, $name)
            ->subject($subject);
    }
}
