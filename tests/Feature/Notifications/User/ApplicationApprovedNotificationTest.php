<?php

namespace Tests\Feature\Notifications\User;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use App\Notifications\User\ApplicationApprovedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class ApplicationApprovedNotificationTest extends TestCase
{
    /**
     * @var NotificationFake
     */
    private $notification;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notification = $this->app->make(NotificationFake::class);
        $this->user = $this->app->make(UserRepository::class)->find(1);
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
    }

    public function testApplicationApprovedNotification()
    {
        $this->notification->send($this->business, new ApplicationApprovedNotification($this->business));
        $this->notification->assertSentTo($this->business, ApplicationApprovedNotification::class, function (ApplicationApprovedNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
