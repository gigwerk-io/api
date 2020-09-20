<?php

namespace App\Http\Controllers\Business;

use App\Enums\ApplicationStatus;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
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
     * @Meta(name="Stats", href="stats", description="Get the statistics to present on the business dashboard.")
     * @ResponseExample(status=200, example="responses/business/dashboard/stats-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function stats(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJobs = $business->marketplaceJobs()->with('payment')->get();

        $totalUsers = $business->users()->count();
        $totalJobs = $marketplaceJobs->count();
        $applicants = $business->applications()->where('status', '=', ApplicationStatus::NEW)->count();
        $payments = $marketplaceJobs->sum(function (MarketplaceJob $marketplaceJob) {
            return $marketplaceJob->payment()->sum('amount');
        });

        $data = [
            'applicants' => $applicants,
            'jobs' => $totalJobs,
            'payments' => $payments,
            'users' => $totalUsers
        ];

        return ResponseFactory::success('Show dashboard stats', $data);
    }

    /**
     * @Meta(name="Graphs", href="graphs", description="Get the graph data to present on the business dashboard.")
     * @ResponseExample(status=200, example="responses/business/dashboard/graphs-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function graphs(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJobs = $business->marketplaceJobs()->with('payout')->get();

        $months = [];
        $payments = [];
        $jobs = [];

        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $filteredJobs = $marketplaceJobs->filter(function (MarketplaceJob $marketplaceJob) use ($month){
                return Carbon::parse($month)->month == Carbon::parse($marketplaceJob->created_at)->month;
            });

            $jobs[] = $filteredJobs->count();
            $payments[] = $filteredJobs->sum(function (MarketplaceJob $marketplaceJob) {
                return $marketplaceJob->payment()->sum('amount');
            });
        }

        $jobsData = [
            'labels' => $months,
            'datasets' => [
                (object)[
                    'label' => 'Jobs',
                    'data' => $jobs
                ]
            ]
        ];

        $payments = [
            'labels' => $months,
            'datasets' => [
                (object)[
                    'label' => 'Payments',
                    'data' => $payments
                ]
            ]
        ];

        return ResponseFactory::success('Show graph data', ['jobs' => $jobsData, 'payments' => $payments]);
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

        $workers = $workers->sortBy(function (User $user) {
            return -$user->amount;
        })->take(10);

        $workers = $workers->map(function (User $user) use ($business) {
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
