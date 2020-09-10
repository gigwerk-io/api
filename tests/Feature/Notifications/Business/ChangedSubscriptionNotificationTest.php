<?php

namespace Tests\Feature\Notifications\BusinessNotifications;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Enum\Billing\Plan;
use App\Models\Business;
use App\Models\User;
use App\Notifications\Business\ChangedSubscriptionNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class ChangedSubscriptionNotificationTest extends TestCase
{
    /**
     * @var NotificationFake
     */
    private $notification;

    /**
     * @var Business
     */
    private $business;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notification = $this->app->make(NotificationFake::class);
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        $this->user = $this->app->make(UserRepository::class)->find(3);
    }


    public function testChangedSubscriptionNotification()
    {
        $this->notification->send($this->business, new ChangedSubscriptionNotification($this->user, Plan::PRO, $this->business));
        $this->notification->assertSentTo($this->business, ChangedSubscriptionNotification::class, function (ChangedSubscriptionNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
