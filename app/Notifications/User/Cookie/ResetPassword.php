<?php

namespace App\Notifications\User\Cookie;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ResetPassword extends Notification
{
    use Queueable;

    public $link;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token, User $user)
    {
        $this->link = route('reset.view', ['token' => $token]);
        $this->user = $user;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("We recieved a password reset request for your account. Please click the button below to change your password.")
                    ->action('Reset Password', url("{{ $this->link }}"))
                    ->line('Thank you for using our application!');
    }
}
