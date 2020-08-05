<?php

namespace App\Notifications\Business;

use App\Enum\Notification\DeploymentMessage;
use App\Enum\Notification\NotificationType;
use App\Models\Deployment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppDeploymentSucceededNotification extends Notification
{
    use Queueable;


    /**
     * @var Deployment
     */
    private $deployment;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $message;


    /**
     * Create a new notification instance.
     *
     * @param Deployment $deployment
     */
    public function __construct(Deployment $deployment)
    {
        $this->deployment = $deployment;
        $this->title = NotificationType::Deployment;
        $this->message = DeploymentMessage::SUCCESSFUL;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database' , 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->message)
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notification_id' => $this->id,
            'title' => NotificationType::Deployment,
            'message' => $this->message,
        ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
