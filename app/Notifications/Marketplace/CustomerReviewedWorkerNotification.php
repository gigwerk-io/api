<?php

namespace App\Notifications\Marketplace;

use App\Enum\Notification\MarketplaceMessage;
use App\Enum\Notification\NotificationType;
use App\Models\MarketplaceJob;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Apn\ApnChannel;
use NotificationChannels\Apn\ApnMessage;
use NotificationChannels\Fcm\FcmChannel;

class CustomerReviewedWorkerNotification extends Notification implements ShouldBroadcast, ShouldQueue
{
    use Queueable, InteractsWithSockets, SerializesModels;

    /**
     * @var MarketplaceJob
     */
    public $marketplaceJob;

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
     * @param MarketplaceJob $marketplaceJob
     */
    public function __construct(MarketplaceJob $marketplaceJob)
    {
        $this->marketplaceJob = $marketplaceJob;
        $this->title = NotificationType::Marketplace;
        $this->message = MarketplaceMessage::CUSTOMER_COMPLETE;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed|User $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'class' => MarketplaceJob::class,
            'class_id' => $this->marketplaceJob->id,
            'business_id' => $this->marketplaceJob->business->id,
            'title' => $this->title,
            'message' => $this->message,
            'page' => '/app/marketplace-detail',
            'params' => $this->marketplaceJob->id
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
            'notification_id' => $this->id,
            'business_uid' => $this->marketplaceJob->business->unique_id,
            'title' => $this->title,
            'message' => $this->message,
            'page' => '/app/marketplace-detail',
            'params' => $this->marketplaceJob->id
        ]);
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
            ['page' => '/app/marketplace-detail', 'params' => $this->marketplaceJob->id],
            $notifiable->unreadNotifications()->count()
        );
    }

    public function toFcm()
    {
        // TODO: Implement
    }

    public function toNexmo()
    {
        // TODO: Implement
    }
}
