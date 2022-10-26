<?php

namespace Tests\Feature\Mail\User;

use App\Contracts\Repositories\UserRepository;
use App\Mail\User\RegisteredMailable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\MailFake;
use Tests\TestCase;

class RegisteredMailableTest extends TestCase
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
        $this->user = $this->app->make(UserRepository::class)->find(1);
    }

    public function testRegisteredMailable() {
        $this->mailer->send(new RegisteredMailable($this->user));
        $this->mailer->assertSent(RegisteredMailable::class, function (RegisteredMailable $mail) {
            return $mail->user === $this->user;
        });
    }

}
