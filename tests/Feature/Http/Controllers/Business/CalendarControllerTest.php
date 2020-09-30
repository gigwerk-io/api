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

/**
 * @coversDefaultClass \App\Http\Controllers\Business\CalendarController
 */
class CalendarControllerTest extends TestCase
{
    const DOC_PATH = 'business/calendar';
    const SHOW_EVENTS_ROUTE = 'show.calendar';

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

    /**
     * @covers ::index
     */
    public function testShowEvents()
    {
        $response = $this->get(route(self::SHOW_EVENTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['date', 'title', 'theme']]]);
        $this->document(self::DOC_PATH, self::SHOW_EVENTS_ROUTE, $response->status(), $response->getContent());
    }
}
