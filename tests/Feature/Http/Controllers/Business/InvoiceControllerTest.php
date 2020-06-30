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
 * @coversDefaultClass \App\Http\Controllers\Business\InvoiceController
 */
class InvoiceControllerTest extends TestCase
{
    const DOC_PATH = 'business/invoice';
    const SHOW_PAST_INVOICES_ROUTE = 'all.invoices';
    const SHOW_UPCOMING_INVOICE_ROUTE = 'upcoming.invoice';

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
    public function testShowPastInvoices()
    {
        $response = $this->get(route(self::SHOW_PAST_INVOICES_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['lines', 'subscription', 'subtotal']]]);
        $this->document(self::DOC_PATH, self::SHOW_PAST_INVOICES_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::upcoming
     */
    public function testShowUpcomingInvoice()
    {
        $response = $this->get(route(self::SHOW_UPCOMING_INVOICE_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['lines', 'subscription', 'subtotal']]);
        $this->document(self::DOC_PATH, self::SHOW_UPCOMING_INVOICE_ROUTE, $response->status(), $response->getContent());
    }
}
