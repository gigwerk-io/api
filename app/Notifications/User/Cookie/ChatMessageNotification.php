<?php

namespace App\Notifications\User\Cookie;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Apn\ApnMessage;

class ChatMessageNotification extends Notification implements ShouldBroadcast, ShouldQueue
{
    use Queueable, InteractsWithSockets, SerializesModels;

    /**
     * @var ChatRoom
     */
    public $room;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $message;

    public function __construct(User $sender, ChatRoom $room, string $message)
    {
        $this->title = $sender->name;
        $this->room = $room;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            'class' => ChatRoom::class,
            'class_id' => $this->room->id,
            'business_id' => $this->room->business_id,
            'notification_id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'page' => '/app/room',
            'params' => $this->room->id
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
            ['page' => '/app/room', 'params' => $this->room->id],
            $notifiable->unreadNotifications()->count()
        );
    }
}
