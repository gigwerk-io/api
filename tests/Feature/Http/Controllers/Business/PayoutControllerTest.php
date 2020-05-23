<?php

namespace Tests\Feature\Http\Controllers\Business;

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
    const DOC_PATH = 'business/payout';
    const ALL_PAYOUTS_ROUTE = 'business.all.payouts';
    const SHOW_PAYOUT_ROUTE = 'business.show.payout';

    /**
     * @var User
     */
    private $admin;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->app->make(UserRepository::class)->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->admin);
    }

    public function testViewAllPayouts()
    {
        self::markTestIncomplete();
        $response = $this->get(route(self::ALL_PAYOUTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        dd($response->getContent());
        $response->assertStatus(200);

    }

    public function testShowPayout()
    {
        self::markTestIncomplete();
        $response = $this->get(route(self::SHOW_PAYOUT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 1]));

        dd('$response->getContent()');
        $response->assertStatus(200);
    }
}
