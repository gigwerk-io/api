<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\IntegrationController
 */
class IntegrationControllerTest extends TestCase
{
    const DOC_PATH = 'business/integration';
    const GENERATE_OAUTH_URL_ROUTE = 'generate.google.url';
    const VIEW_BUSINESS_INTEGRATIONS_ROUTE = 'business.integrations';
    const UPDATE_BUSINESS_INTEGRATIONS_ROUTE = 'update.business.integrations';

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
     * @covers ::show
     */
    public function testViewIntegrations()
    {
        $response = $this->get(route(self::VIEW_BUSINESS_INTEGRATIONS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['facebook_pixel_id', 'google_analytics_id', 'calendar_enabled']]);
        $this->document(self::DOC_PATH, self::VIEW_BUSINESS_INTEGRATIONS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testUpdateIntegrations()
    {
        $response = $this->patch(route(self::UPDATE_BUSINESS_INTEGRATIONS_ROUTE, ['unique_id' => $this->business->unique_id]),
            ['facebook_pixel_id' => 'foo', 'google_analytics_id' => 'bar']
        );

        $response->assertStatus(200);
        $this->assertDatabaseHas('business_integrations', [
            'business_id' => $this->business->id,
            'facebook_pixel_id' => 'foo',
            'google_analytics_id' => 'bar'
        ]);
        $this->document(self::DOC_PATH, self::UPDATE_BUSINESS_INTEGRATIONS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::generateOAuthUrl
     */
    public function testGenerateOAuthUrl()
    {
        $response = $this->post(route(self::GENERATE_OAUTH_URL_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['url']]);
        $this->document(self::DOC_PATH, self::GENERATE_OAUTH_URL_ROUTE, $response->status(), $response->getContent());
    }

    public function testGenerateOAuthToken()
    {
        self::markTestSkipped();
    }
}
