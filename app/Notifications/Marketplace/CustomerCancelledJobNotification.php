<?php

namespace App\Notifications\Marketplace;

use App\Enum\Notification\MarketplaceMessage;
use App\Enum\Notification\NotificationType;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Apn\ApnChannel;
use NotificationChannels\Apn\ApnMessage;
use NotificationChannels\Fcm\FcmChannel;

class CustomerCancelledJobNotification extends Notification implements ShouldBroadcast, ShouldQueue
{
    use Queueable, InteractsWithSockets, SerializesModels;

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
    public function __construct()
    {
        $this->title = NotificationType::Marketplace;
        $this->message = MarketplaceMessage::CUSTOMER_CANCEL;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ApnChannel::class];
    }

    /**
     * Send to iOS device.
     *
     * @param  mixed|User  $notifiable
     * @return ApnMessage
     */
    public function toApn($notifiable)
    {
        return ApnMessage::create(
            $this->title,
            $this->message,
            [],
            $notifiable->unreadNotifications()->count()
        );
    }

    public function toFcm()
    {
        // TODO: Implement
    }
}
