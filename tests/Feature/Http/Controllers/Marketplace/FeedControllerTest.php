<?php

namespace Tests\Feature\Http\Controllers\Marketplace;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FeedControllerTest extends TestCase
{
    const DOC_PATH = 'marketplace/feed';

    /**
     * @var User
     */
    private $customer;

    /**
     * @var User
     */
    private $worker;

    protected function setUp(): void
    {
        parent::setUp();
        // Get customer
        $this->customer = $this->app->make(UserRepository::class)->find(1);
        // Get primary worker
        $this->worker = $this->app->make(UserRepository::class)->find(2);
    }

    public function test_view_single_job_with_geolocation()
    {
        $route = 'job.feed';
        $this->actingAs($this->worker);
        $response = $this->get(route($route, ['id' => 1, 'lat' => 44.018219, 'long' => -92.461635]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => ['id', 'proposals', 'category_id', 'price', 'customer'],
        ]);
    }
}
