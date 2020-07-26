<?php

namespace App\Notifications\Business;

use App\Models\Business;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserAppliedNotification extends Notification
{
    use Queueable;

    public $user;
    public $owner;
    public $business;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $owner, Business $business)
    {
        $this->user = $user;
        $this->owner = $owner;
        $this->business = $business;
        $this->title = "Business";
        $this->message = "Someone applied to your business!";
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
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'class' => Business::class,
            'class_id' => $this->business->id,
            'business_id' => $this->business->id,
            'business_owner_id' => $this->owner->id,
            'user_id' => $this->user->id,
            'title' => $this->title,
            'message' => $this->message,
            'page' => '/applicant/:id',
            'params' => $this->user->id
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed|User  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'class' => Business::class,
            'class_id' => $this->business->id,
            'business_id' => $this->business->id,
            'business_owner_id' => $this->owner->id,
            'user_id' => $this->user->id,
            'notification_id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'page' => '/applicant/:id',
            'params' => $this->user->id
        ]);
    }
}
