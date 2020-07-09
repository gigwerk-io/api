<?php
 
namespace App\Mail\User;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
 
class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
 
    public $link;
    public $user;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token, User $user)
    {
        $this->link = route('reset.view', ['token' => $token]);
        $this->user = $user;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'no-reply@gigwerk.io';
        $subject = 'Passord Reset!';
        $name = getenv('MAIL_FROM_NAME');
        return $this->markdown('mail.user.reset-password')->from($address, $name)
            ->subject($subject)
            ->with('url', $this->link);
    }
}
