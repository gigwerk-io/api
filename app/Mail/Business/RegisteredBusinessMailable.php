<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegisteredBusinessMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $business;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $business)
    {
        $this->user = $user;
        $this->business = $business;
        $this->link = route('stats', ['unique_id' => $business->unique_id]);
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\RegisteredBusinessMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'You just created "' . $this->business->name . '" !';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.Business.NewBusiness')->from($address, $name)
            ->subject($subject);
    }
}
