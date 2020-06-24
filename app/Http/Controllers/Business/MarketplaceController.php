<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\MarketplaceJob;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Marketplace", description="These routes manage the company's marketplace.")
 */
class MarketplaceController extends Controller
{
    /**
     * @Meta(name="All Jobs", description="View all jobs in a business marketplace.", href="all-jobs")
     * @ResponseExample(status=200, example="responses/business/marketplace/all.marketplace.jobs-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJobs = $business->marketplaceJobs()
            ->with(['customer.profile', 'proposals.user.profile', 'category'])
            ->get();

        return ResponseFactory::success('Show all marketplace jobs', $marketplaceJobs);
    }

    /**
     * @Meta(name="Show job", description="Show a single job in a business marketplace.", href="show-job")
     * @ResponseExample(status=200, example="responses/business/marketplace/show.marketplace.job-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJob = $business->marketplaceJobs()
            ->with(['customer.profile', 'proposals.user.profile', 'category', 'location'])
            ->where('id', '=', $request->id)
            ->first();

        if (is_null($marketplaceJob)) {
            return ResponseFactory::error(
                'This job does not exist or you are not authorized',
                null,
                404
            );
        }


        return ResponseFactory::success('Show single job', $marketplaceJob);
    }
}
