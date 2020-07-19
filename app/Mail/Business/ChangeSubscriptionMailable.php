<?php

namespace App\Mail\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeSubscriptionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscriptionName;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $subscriptionName, $business_id)
    {
        $this->user = $user;
        $this->subscriptionName = $subscriptionName;
        $this->link = route('show.subscription.plan', ['unique_id' => $business_id]);
    }

    /**
     * Build the message.
     *
     * @return \App\Mail\Business\ChangeSubscriptionMailable
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'You changed your subscription plan!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.Business.ChangeSubscription')->from($address, $name)
            ->subject($subject);
    }
}
