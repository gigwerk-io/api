<?php

namespace Tests\Feature\Notifications\Marketplace;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Models\MarketplaceJob;
use App\Notifications\Marketplace\WorkerAcceptedJobNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class WorkerAcceptedJobNotificationTest extends TestCase
{
    /**
     * @var NotificationFake
     */
    private $notification;

    /**
     * @var MarketplaceJob
     */
    private $marketplaceJob;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notification = $this->app->make(NotificationFake::class);
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        $this->marketplaceJob = $this->business->marketplaceJobs()->first();
    }

    public function testWorkerAcceptedJobNotification()
    {
        $this->notification->send($this->marketplaceJob, new WorkerAcceptedJobNotification($this->marketplaceJob));
        $this->notification->assertSentTo($this->marketplaceJob, WorkerAcceptedJobNotification::class, function (WorkerAcceptedJobNotification $notification) {
            return $this->marketplaceJob === $notification->marketplaceJob;
        });
    }
}
