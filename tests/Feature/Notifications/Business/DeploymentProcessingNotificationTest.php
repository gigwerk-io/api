<?php

namespace Tests\Feature\Notifications\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Notifications\Business\DeploymentProcessingNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class DeploymentProcessingNotificationTest extends TestCase
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

    public function testDeploymentProcessingNotification()
    {
        $this->notification->send($this->business, new DeploymentProcessingNotification($this->business));
        $this->notification->assertSentTo($this->business, DeploymentProcessingNotification::class, function (DeploymentProcessingNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
