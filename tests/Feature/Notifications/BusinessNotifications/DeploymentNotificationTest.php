<?php

namespace Tests\Feature;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Notifications\Business\AppDeploymentFailedNotification;
use App\Notifications\Business\AppDeploymentSucceededNotification;
use App\Notifications\Business\BusinessRegistrationNotification;
use App\Notifications\Business\DeploymentProcessingNotification;
use App\Notifications\Business\DeploymentQueuedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class DeploymentNotificationTest extends TestCase
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

    public function testAppDeploymentFailedNotification()
    {
        $this->notification->send($this->business, new AppDeploymentFailedNotification($this->business));
        $this->notification->assertSentTo($this->business, AppDeploymentFailedNotification::class, function (AppDeploymentFailedNotification $notification) {
            return $notification->getBusiness() === $this->business;
        });
    }

    public function testAppDeploymentSucceededNotification()
    {
        $this->notification->send($this->business, new AppDeploymentSucceededNotification($this->business));
        $this->notification->assertSentTo($this->business, AppDeploymentSucceededNotification::class, function (AppDeploymentSucceededNotification $notification) {
            return $notification->getBusiness() === $this->business;
        });
    }

    public function testDeploymentProcessingNotification()
    {
        $this->notification->send($this->business, new DeploymentProcessingNotification($this->business));
        $this->notification->assertSentTo($this->business, DeploymentProcessingNotification::class, function (DeploymentProcessingNotification $notification) {
            return $notification->getBusiness() === $this->business;
        });
    }

    public function testDeploymentQueuedNotification()
    {
        $this->notification->send($this->business, new DeploymentQueuedNotification ($this->business));
        $this->notification->assertSentTo($this->business, DeploymentQueuedNotification ::class, function (DeploymentQueuedNotification $notification) {
            return $notification->getBusiness() === $this->business;
        });
    }
}
