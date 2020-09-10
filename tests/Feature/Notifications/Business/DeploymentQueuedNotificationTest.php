<?php

namespace Tests\Feature\Notifications\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Notifications\Business\DeploymentQueuedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class DeploymentQueuedNotificationTest extends TestCase
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

    public function testDeploymentQueuedNotification()
    {
        $this->notification->send($this->business, new DeploymentQueuedNotification ($this->business));
        $this->notification->assertSentTo($this->business, DeploymentQueuedNotification ::class, function (DeploymentQueuedNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
