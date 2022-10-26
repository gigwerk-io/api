<?php

namespace Tests\Feature\Mail\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Mail\Business\WeeklySummaryMailable;
use App\Models\Application;
use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\MailFake;
use Tests\TestCase;

class WeeklySummaryMailableTest extends TestCase
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

    public function testWeeklySummaryMailable() {
        $this->mailer->send(new WeeklySummaryMailable($this->business->owner , $this->business, 2,6,7,8));
        $this->mailer->assertSent(WeeklySummaryMailable::class, function (WeeklySummaryMailable $mail) {
            return $mail->user === $this->business->owner;
         });
    }
}
