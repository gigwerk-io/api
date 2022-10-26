<?php

namespace Tests\Feature\Http\Controllers\Business;

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
 * @coversDefaultClass \App\Http\Controllers\Business\FormController
 */
class FormControllerTest extends TestCase
{
    const DOC_PATH = 'business/form';
    const SHOW_FORM_ROUTE = 'show.form';
    const UPDATE_FORM_ROUTE = 'update.form';

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
    public function testShowForm()
    {
        $response = $this->get(route(self::SHOW_FORM_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['formComponents', 'formHeader']]);
        $this->document(self::DOC_PATH, self::SHOW_FORM_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testUpdateForm()
    {
        $body = json_decode(
            file_get_contents(database_path('data/applicant-form.json'))
        , true);

        $response = $this->patch(route(self::UPDATE_FORM_ROUTE, ['unique_id' => $this->business->unique_id]), $body);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your business form has been updated.'));
        $this->document(self::DOC_PATH, self::UPDATE_FORM_ROUTE, $response->status(), $response->getContent());
    }
}
