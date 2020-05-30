<?php

namespace App\Http\Controllers\Business;

use Solomon04\Documentation\Annotation\Meta;
use App\Contracts\Repositories\PayoutRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * @var PayoutRepository
     */
    private $payoutRepository;

    public function __construct(PayoutRepository $payoutRepository)
    {
        $this->payoutRepository = $payoutRepository;
    }

    /**
     * @Meta(name="All Payouts", description="View all payouts made by your business.", href="all-payouts")
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business = $request->get('business');

        $payouts = $this->payoutRepository->with('user.profile')->whereHas('marketplaceJob', function ($query) use ($business){
            $query->where('business_id', '=', $business->id);
        });

        dd($business);

        return ResponseFactory::success('Show payouts', $payouts);
    }

    public function show(Request $request)
    {
        $business = $request->get('business');

        $payout = $this->payoutRepository->with(['user.profile', 'marketplaceJob.customer'])->whereHas('marketplaceJob', function ($query) use ($business){
            $query->where('business_id', '=', $business->id);
        })->findWhere(['id' => $request->id]);

        if (is_null($payout)) {
            return ResponseFactory::error(
                'Payout does not exist.',
                null,
                404
            );
        }

        return ResponseFactory::success('Show payout', $payout);
    }
}
