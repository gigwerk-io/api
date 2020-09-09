<?php

namespace App\Notifications\Business;

use App\Enum\Notification\BusinessMessage;
use App\Enum\Notification\NotificationType;
use App\Models\Business;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BusinessApprovedNotification extends Notification
{
    use Queueable;

    /**
     * @var Business
     */
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
     * @param Business $business
     */
    public function __construct(Business $business)
    {
        $this->business = $business;
        $this->title = NotificationType::Business;
        $this->message = BusinessMessage::APPROVED;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database'];
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
            ->subject('Business Approved!')
            ->markdown('mail.business.business-approved-notification');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
        ];
    }

}
