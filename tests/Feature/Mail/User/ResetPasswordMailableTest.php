<?php

namespace Tests\Feature\Mail\User;

use App\Contracts\Repositories\UserRepository;
use App\Mail\User\ResetPasswordMailable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\MailFake;
use Tests\TestCase;

class ResetPasswordMailableTest extends TestCase
{
    /**
     * @var MailFake
     */
    private $mailer;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mailer = $this->app->make(MailFake::class);
        $this->user   = $this->app->make(UserRepository::class)->find(1);
    }

    public function testResetPasswordMailable()
    {
        $this->mailer->send(new ResetPasswordMailable("Token", $this->user));
        $this->mailer->assertSent(ResetPasswordMailable::class , function (ResetPasswordMailable $mail) {
            return $mail->user === $this->user;
        });
    }
}
