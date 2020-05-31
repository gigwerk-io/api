<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\User\AccountController
 */
class AccountControllerTest extends TestCase
{
    const DOC_PATH = 'user/account';
    const SAVE_APN_ROUTE = 'save.apn.token';
    const SAVE_FCM_ROUTE = 'save.fcm.token';
    const UPDATE_NOTIFICATIONS_ROUTE = 'update.notification.preferences';

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
        $this->user = $this->app->make(UserRepository::class)->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->user);
    }

    /**
     * @covers ::updateApnToken
     */
    public function testSaveApn()
    {
        $response = $this->post(route(self::SAVE_APN_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'token' => 'foo'
        ]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('APN token has been saved.'));
        $this->document(self::DOC_PATH, self::SAVE_APN_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::updateFcmToken
     */
    public function testSaveFcm()
    {
        $response = $this->post(route(self::SAVE_FCM_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'token' => 'bar'
        ]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('FCM token has been saved.'));
        $this->document(self::DOC_PATH, self::SAVE_FCM_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::updateNotificationPreferences
     */
    public function testUpdateNotificationPreferences()
    {
        $response = $this->post(route(self::UPDATE_NOTIFICATIONS_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'email_notifications' => true,
            'sms_notifications'=> false,
            'push_notifications'=> true
        ]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your notification settings have been updated'));
        $this->document(self::DOC_PATH, self::UPDATE_NOTIFICATIONS_ROUTE, $response->status(), $response->getContent());
    }
}
