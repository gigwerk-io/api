<?php

namespace Tests\Feature\Notifications\BusinessNotifications;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Notifications\Business\BusinessRegistrationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class BusinessRegistrationNotificationTest extends TestCase
{
    /**
     * @var NotificationFake
     */
    private $notification;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notification = $this->app->make(NotificationFake::class);
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
    }


    public function testBusinessRegistrationNotification()
    {
        $this->notification->send($this->business, new BusinessRegistrationNotification($this->business));
        $this->notification->assertSentTo($this->business, BusinessRegistrationNotification::class, function (BusinessRegistrationNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
