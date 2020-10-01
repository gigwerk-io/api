<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Dashboard\Dashboard;
use App\Dashboard\DashboardProvider;
use App\Enums\ApplicationStatus;
use App\Models\Application;
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

    /**
     * @var Dashboard
     */
    private $dashboard;

    public function __construct(
        MarketplaceJobRepository $marketplaceJobRepository,
        PaymentRepository $paymentRepository,
        DatabaseManager $databaseManager,
        Dashboard $dashboard
    )
    {
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->paymentRepository = $paymentRepository;
        $this->databaseManager = $databaseManager;
        $this->dashboard = $dashboard;
    }

    /**
     * @Meta(name="Metrics", description="Show a list of metrics to display as cards on the dashboard.", href="metrics")
     * @ResponseExample(status=200, example="responses/business/dashboard/metrics-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function metrics(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $applicants = $business->applications()->get();
        $workers = $business->users()->get();
        $jobs = $business->marketplaceJobs()->get();

        $applicantMetrics = $this->dashboard->getApplicantMetrics($applicants);
        $workerMetrics = $this->dashboard->getWorkerMetrics($workers);
        $jobMetrics = $this->dashboard->getJobMetrics($jobs);
        $hiringMetrics = $this->dashboard->getHiringRate($applicants);

        return ResponseFactory::success('Show metrics', [
            'applications' => $applicantMetrics,
            'workers' => $workerMetrics,
            'jobs' => $jobMetrics,
            'hiring' => $hiringMetrics
        ]);
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
}
