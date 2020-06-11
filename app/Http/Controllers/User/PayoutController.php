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
 * @Group(name="Payouts", description="These routes belong are responsible for show user payouts.")
 */
class PayoutController extends Controller
{
    /**
     * @Meta(name="All payouts", href="all-payouts", description="Show a list of all payouts within a business app.")
     * @ResponseExample(status=200, example="responses/user/payout/all.user.payouts-200.json")
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

        $payouts = $user->payouts()->whereHas('marketplaceJob', function ($query) use ($business){
            return $query->where('business_id', '=', $business->id);
        })->get();


        return ResponseFactory::success('Show all payouts', $payouts);
    }


    /**
     * @Meta(name="Single payout", href="single-payout", description="Show a single payout with the job and user.")
     * @ResponseExample(status=200, example="responses/user/payout/show.user.payout-200.json")
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

        $payout = $user->payouts()->whereHas('marketplaceJob', function ($query) use ($business){
            return $query->where('business_id', '=', $business->id);
        })->where('id', '=', $request->id)->first();


        return ResponseFactory::success('Show payout', $payout);
    }
}
