<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PayoutControllerTest extends TestCase
{
    const DOC_PATH = 'user/payout';
    const ALL_PAYOUTS_ROUTE = 'all.user.payouts';
    const SHOW_PAYOUT_ROUTE = 'show.user.payout';

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
     * @covers ::index
     */
    public function testViewPayouts()
    {
        $response = $this->get(route(self::ALL_PAYOUTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['marketplace_id', 'user_id', 'amount', 'stripe_token']]]);
        $this->document(self::DOC_PATH, self::ALL_PAYOUTS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowPayout()
    {
        $response = $this->get(route(self::SHOW_PAYOUT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 1]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['user_id', 'amount', 'stripe_token']]);
        $this->document(self::DOC_PATH, self::SHOW_PAYOUT_ROUTE, $response->status(), $response->getContent());
    }
}
