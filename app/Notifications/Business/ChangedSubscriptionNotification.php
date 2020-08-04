<?php

namespace App\Notifications\Business;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Business;

class ChangedSubscriptionNotification extends Notification
{
    use Queueable;

    /** @var User */
    public $user;

    /** @var Business */
    public $business;

    /** @var string */
    public $subscriptionName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $subscriptionName, Business $business)
    {
        $this->user = $user;
        $this->subscriptionName = $subscriptionName;
        $this->business = $business;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toDatabase($notifiable)
    {
        return [
            'class' => User::class,
            'class_id' => $this->user->id,
            'user_id' => $this->user->id,
            'title' => 'Changed Subscription',
            'message' => 'You changed you subscription to ' . $this->subscriptionName,
            'page' => '/subscription',
            'params' => null
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     * @param  mixed|User  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'class' => User::class,
            'class_id' => $this->user->id,
            'user_id' => $this->user->id,
            'notification_id' => $this->id,
            'title' => 'Changed Subscription',
            'message' => 'You changed you subscription for ' . $this->subscriptionName,
            'page' => '/subscription',
            'params' => null
        ]);
    }
}
