<?php

namespace Tests\Feature;

use App\Contracts\Repositories\BusinessRepository;
use App\Mail\Business\UserAppliedMailable;
use App\Models\Application;
use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\MailFake;
use Tests\TestCase;

class UserAppliedMailableTest extends TestCase
{

    /**
     * @var MailFake
     */
    private $mailer;

    /**
     * @var Business
     */
    private $business;

    /**
     * @var Application
     */
    private $application;


    protected function setUp(): void
    {
        parent::setUp();
        $this->mailer = $this->app->make(MailFake::class);
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        $this->application = $this->business->applications()->first();
    }

    public function testUserAppliedMailable()
    {
        $this->mailer->send(new UserAppliedMailable($this->business , $this->application));
        $this->mailer->assertSent(UserAppliedMailable::class, function (UserAppliedMailable $mail) {
            return $mail->owner === $this->business->owner;
    });
    }
}
