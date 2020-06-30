<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Laravel\Cashier\Invoice;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Invoice", description="View past and future invoices for a business.")
 */
class InvoiceController extends Controller
{
    /**
     * @Meta(name="Past Invoices", description="Show all past invoices for a business.", href="past-invoices")
     * @ResponseExample(status=200, example="responses/business/invoice/all.invoices-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $invoices = $business->invoices()->map(function (Invoice $invoice){
            return $invoice->asStripeInvoice();
        });
        return ResponseFactory::success('Show business invoices', $invoices);
    }

    /**
     * @Meta(name="Upcoming Invoice", description="Show upcoming invoice for a business.", href="upcoming-invoice")
     * @ResponseExample(status=200, example="responses/business/invoice/upcoming.invoice-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upcoming(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $invoice = $business->upcomingInvoice()->asStripeInvoice();

        return ResponseFactory::success('Show upcoming invoice', $invoice);
    }
}
