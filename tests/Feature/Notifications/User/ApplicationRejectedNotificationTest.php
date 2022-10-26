<?php

namespace Tests\Feature\Notifications\User;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use App\Notifications\User\ApplicationRejectedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Tests\TestCase;

class ApplicationRejectedNotificationTest extends TestCase
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

    public function testApplicationRejectedNotification()
    {
        $this->notification->send($this->business, new ApplicationRejectedNotification($this->business));
        $this->notification->assertSentTo($this->business, ApplicationRejectedNotification::class, function (ApplicationRejectedNotification $notification) {
            return $notification->business === $this->business;
        });
    }
}
