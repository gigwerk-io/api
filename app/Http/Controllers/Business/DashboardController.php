<?php

namespace App\Http\Controllers\Business;

use App\Annotation\Group;
use App\Annotation\Meta;
use App\Annotation\ResponseExample;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\PaymentRepository;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\MarketplaceJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;

/**
 * @Group(name="Dashboard", description="This allows you to view statistics and performance of their marketplaces")
 */
class DashboardController extends Controller
{
    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    public function __construct(
        MarketplaceJobRepository $marketplaceJobRepository,
        PaymentRepository $paymentRepository,
        DatabaseManager $databaseManager
    )
    {
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->paymentRepository = $paymentRepository;
        $this->databaseManager = $databaseManager;
    }

    /**
     * @Meta(name="User Stats", description="Get user statistics like total count and growth.", href="user-stats")
     * @ResponseExample(status=200, example="responses/business/dashboard/user.stats-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function userStats(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $users = $business->users()->get();

        $total = $users->count();
        $month = Carbon::now()->format('M');
        $lastMonth = Carbon::now()->subMonth()->format('M');

        $group = $users->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('M');
        });

        if (isset($group[$month])) {
            $currentMonthTotal = count($group[$month]);
        } else {
            $currentMonthTotal = 0;
        }

        if (isset($group[$lastMonth])) {
            $lastMonthTotal = count($group[$lastMonth]);
        } else {
            $lastMonthTotal = 1;
        }

        $growth = ($currentMonthTotal - $lastMonthTotal)/$lastMonthTotal * 100;

        return ResponseFactory::success(
            'Generating user stats',
            ['total' => $total, 'growth' => $growth]
        );
    }

    /**
     * @Meta(name="Traffic Stats", description="Get the your business app usage statistics.", href="traffic-stats")
     * @ResponseExample(status=200, example="responses/business/dashboard/traffic.stats-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function trafficStats(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $users = $business->users()->get();

        $users = $users->filter(function (User $user){
            return $user->isActive;
        });



        return ResponseFactory::success(
            'Generating traffic stats',
            ['total' => $users->count(), 'growth' => 0]
        );
    }

    /**
     * @Meta(name="Time Worked", description="Show the total amount of time worked in minutes.", href="time-worked")
     * @ResponseExample(status=200, example="responses/business/dashboard/time.worked-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function totalTimeWorked(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');
        $jobs = $business->marketplaceJobs()->with('proposals')->where(['status_id' => Status::COMPLETE])->get();

        $sum = $jobs->sum(function(MarketplaceJob $job){
            $proposal = $job->proposals()->where(['marketplace_id' => $job->id, 'status_id' => ProposalStatus::APPROVED])->first();
            $startTime = Carbon::parse($proposal->arrived_at)->timestamp;
            $finishTime = Carbon::parse($proposal->completed_at)->timestamp;
            return $finishTime - $startTime;
        });

        return ResponseFactory::success(
            'Generating total time worked in minutes',
            ['minutes' => ($sum / 60)]
        );
    }

    /**
     * @Meta(name="Jobs Graph", description="Get the jobs over time via a graph.", href="jobs-graph")
     * @ResponseExample(status=200, example="responses/business/dashboard/jobs.graph-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function jobsGraph(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $months = [];
        $jobs = [];
        $label = "Jobs";
        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $jobs[] = $business->marketplaceJobs()->whereIn($this->databaseManager->raw('MONTH(created_at)'), [Carbon::parse($month)->format('m')])->count();
        }

        $chartData = [
            "labels" => $months,
            "datasets" => [
                (object)[
                    "label" => $label,
                    "data" => $jobs
                ]
            ]
        ];
        return ResponseFactory::success(
            'Generating jobs graph',
            $chartData
        );
    }

    /**
     * @Meta(name="Payouts Graph", description="Get the payouts over time via a graph.", href="payouts-graph")
     * @ResponseExample(status=200, example="responses/business/dashboard/payouts.graph-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function payoutsGraph(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $months = [];
        $sales = [];
        $label = "Payouts";
        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $sales[] = $this->paymentRepository->whereHas('marketplaceJob', function ($query) use ($business){
                $query->where('business_id', '=', $business->id);
            })->findWhereIn($this->databaseManager->raw('MONTH(created_at)'), [Carbon::parse($month)->format('m')])->sum('amount');
        }

        $chartData = [
            "labels" => $months,
            "datasets" => [
                (object)[
                    "label" => $label,
                    "data" => $sales
                ]
            ]
        ];
        return ResponseFactory::success(
            'Generating sales graph',
            $chartData
        );
    }

    /**
     * @Meta(name="Leaderboard", description="Get all users of a business in order of performance.", href="leaderboard")
     * @ResponseExample(status=200, example="responses/business/dashboard/business.leaderboard-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function leaderboard(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $workers = $business->users()->with('profile')->get();

        $workers = $workers->sortBy(function(User $user){
            return -$user->amount;
        })->take(10);

        $workers = $workers->map(function (User $user) use ($business){
            $user->append(['amount']);
            $user->rating = $user->getRating($business->id);
            $user->makeHidden('payouts');
            return $user;
        })->toArray();

        return ResponseFactory::success(
            'Showing the top workers',
            array_values($workers)
        );
    }
}
