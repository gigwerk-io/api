<?php

namespace App\Http\Controllers\Marketplace;

use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Geolocation\Geolocation;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\MarketplaceLocationRepository;
use App\Enum\Marketplace\PerformableAction;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\MarketplaceJob;
use App\Models\User;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\QueryParam;
use Stevebauman\Location\Location;

/**
 * @Group(name="Feed", description="These routes are responsible for viewing jobs on the feed or your own jobs.")
 */
class FeedController extends Controller
{
    /**
     * @var Geolocation
     */
    private $geolocation;

    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var MarketplaceLocationRepository
     */
    private $marketplaceLocationRepository;

    /**
     * @var Location
     */
    private $ipLocation;

    public function __construct(
        Geolocation $geolocation,
        MarketplaceJobRepository $marketplaceJobRepository,
        MarketplaceLocationRepository $marketplaceLocationRepository,
        Location $ipLocation
    )
    {
        $this->geolocation = $geolocation;
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->marketplaceLocationRepository = $marketplaceLocationRepository;
        $this->ipLocation = $ipLocation;
    }

    /**
     * @Meta(name="Job Feed", description="View the active jobs on the marketplace feed", href="feed")
     * @QueryParam(name="lat", type="float", status="optional", description="The latitude of the users viewing the feed.", example="44.33123")
     * @QueryParam(name="long", type="float", status="optional", description="The longitude of the users viewing the feed.", example="-92.13123")
     * @ResponseExample(status=200, example="responses/marketplace/feed/job.feed-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function feed(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');
        $this->validate($request, ['lat' => 'numeric', 'long' => 'numeric']);
        // Get location of IP address
        $ipLocation = $this->ipLocation->get();
        if ($request->has('lat') && $request->has('long')) {
            $coordinates = [
                'lat' => $request->lat,
                'long' => $request->long
            ];
        } else {
            // If user rejects geolocation, use IP location
            $coordinates = [
                'lat' => $ipLocation->latitude,
                'long' => $ipLocation->longitude
            ];
        }

        $jobs = $this->marketplaceJobRepository->getRequestedJobs($business->id);


        $jobs->filter(function (MarketplaceJob $marketplaceJob) use ($coordinates) {
            $distance = $this->geolocation->calculateDistanceBetweenTwoPoints(
                $marketplaceJob->location->lat,
                $marketplaceJob->location->long,
                $coordinates['lat'],
                $coordinates['long']
            );

            return $distance <= 25;
        });

        // Determine possible actions a user can perform on a job.
        $jobs->map(function (MarketplaceJob $marketplaceJob) use ($coordinates, $user, $business) {
            if ($marketplaceJob->isOwner($user->id)) {
                $marketplaceJob['action'] = $marketplaceJob->getPerformableCustomerAction();
            } elseif ($user->isVerifiedFreelancer($business->id)) {
                $marketplaceJob['action'] = $marketplaceJob->getPerformableWorkerAction($user->id);
            } else {
                $marketplaceJob['action'] = PerformableAction::NO_PERFORMABLE_ACTION;
            }

            $marketplaceJob['distance_away'] = $this->geolocation->calculateDistanceBetweenTwoPoints(
                $marketplaceJob->location->lat,
                $marketplaceJob->location->long,
                $coordinates['lat'],
                $coordinates['long']
            );
            $marketplaceJob->makeHidden('location');
            return $marketplaceJob;
        });

        return ResponseFactory::success(
            'Showing job feed',
            $jobs
        );
    }

    /**
     * @Meta(name="Show Job", description="Show the details of a single job request.", href="view-job")
     * @QueryParam(name="lat", type="float", status="optional", description="The latitude of the user viewing the feed.", example="44.33123")
     * @QueryParam(name="long", type="float", status="optional", description="The longitude of the user viewing the feed.", example="-92.13123")
     * @ResponseExample(status=200, example="responses/marketplace/feed/view.job-200.json")
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
        $this->validate($request, ['lat' => 'numeric', 'long' => 'numeric']);
        // Get location of IP address
        $ipLocation = $this->ipLocation->get();

        if ($request->has('lat') && $request->has('long')) {
            $coordinates = [
                'lat' => $request->lat,
                'long' => $request->long
            ];
        } else {
            // If user rejects geolocation, use IP location
            // TODO: Remove! this might be in violation of privacy policy and law in future
            $coordinates = [
                'lat' => $ipLocation->latitude,
                'long' => $ipLocation->longitude
            ];
        }

        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');
        $marketplaceJob->update(['views' => $marketplaceJob['views'] + 1]);
        $marketplaceJob->load(['customer.profile', 'location', 'category', 'proposals.user.profile']);
        $marketplaceJob['distance_away'] = $this->geolocation->calculateDistanceBetweenTwoPoints(
            $marketplaceJob->location->lat,
            $marketplaceJob->location->long,
            $coordinates['lat'],
            $coordinates['long']
        );

        if ($marketplaceJob->isOwner($user->id)) {
            $marketplaceJob['action'] = $marketplaceJob->getPerformableCustomerAction();
        } elseif ($user->isVerifiedFreelancer($business->id)) {
            $marketplaceJob['action'] = $marketplaceJob->getPerformableWorkerAction($user->id);
            $actionsArray = [
                PerformableAction::NO_PERFORMABLE_ACTION,
                PerformableAction::JOB_IS_COMPLETE,
                PerformableAction::JOB_CAN_BE_ACCEPTED,
                PerformableAction::WORKER_IS_WAITING_FOR_CUSTOMER
            ];
            // hide location if it is in the actions array
            if (in_array($marketplaceJob['action'], $actionsArray)) {
                $marketplaceJob->makeHidden('location');
            }
        } else {
            $marketplaceJob->makeHidden('location');
            $marketplaceJob['action'] = PerformableAction::NO_PERFORMABLE_ACTION;
        }


        return ResponseFactory::success(
            'Showing a job',
            $marketplaceJob
        );
    }

    /**
     * @Meta(name="My Job Requests", description="Show a customers requested jobs.", href="customer-jobs")
     * @ResponseExample(status=200, example="responses/marketplace/feed/customer.jobs-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function myJobRequests(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');

        $jobs = $this->marketplaceJobRepository->with([
            'customer.profile',
            'location',
            'proposals.user.profile'
        ])->findWhere(['customer_id' => $user->id, 'business_id' => $business->id]);
        $jobs->map(function (MarketplaceJob $job) {
            if ($job->isComplete()) {
                $job['action'] = PerformableAction::JOB_CAN_BE_ACCEPTED;
            } elseif ($job->isInProgress()) {
                $job['action'] = PerformableAction::CUSTOMER_WAITING_FOR_WORKER_TO_FINISH;
            } else {
                $job['action'] = PerformableAction::JOB_IS_EDITABLE;
            }
            return $job;
        });

        return ResponseFactory::success(
            'Showing my jobs as a customer',
            $jobs
        );
    }

    /**
     * @Meta(name="My Proposals", description="The active/past proposals a worker has made on jobs.", href="worker-jobs")
     * @ResponseExample(status=200, example="responses/marketplace/feed/worker.jobs-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function myProposals(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');

        $jobs = $this->marketplaceJobRepository->with([
            'customer.profile',
            'location',
            'category',
            'proposals.user.profile'
        ])->whereHas('proposals', function ($val) use ($user) {
            $val->where('user_id', '=', $user->id);
        })->findWhere(['business_id' => $business->id]);

        $jobs->map(function (MarketplaceJob $job) use ($user) {
            $job['action'] = $job->getPerformableWorkerAction($user->id);
            return $job;
        });

        return ResponseFactory::success(
            'Showing my proposals as a worker',
            $jobs
        );
    }
}
