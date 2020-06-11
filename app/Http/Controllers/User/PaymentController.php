<?php

namespace App\Http\Controllers\User;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Payments", description="These routes belong are responsible for show user payments.")
 */
class PaymentController extends Controller
{

    /**
     * @Meta(name="All Payments", href="all-payments", description="Show a list of all payments within a business app.")
     * @ResponseExample(status=200, example="responses/user/payment/all.user.payments-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Business $business */
        $business = $request->get('business');

        $payments = $user->payments()->whereHas('marketplaceJob', function ($query) use ($business){
            return $query->where('business_id', '=', $business->id);
        })->get();


        return ResponseFactory::success('Show all payments', $payments);
    }


    /**
     * @Meta(name="Single Payment", href="single-payment", description="Show a single payment with the job and user.")
     * @ResponseExample(status=200, example="responses/user/payment/show.user.payment-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Business $business */
        $business = $request->get('business');

        $payment = $user->payments()->whereHas('marketplaceJob', function ($query) use ($business){
            return $query->where('business_id', '=', $business->id);
        })->where('id', '=', $request->id)->first();


        return ResponseFactory::success('Show payment', $payment);
    }
}
