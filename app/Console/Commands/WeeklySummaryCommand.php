<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\ApplicationRepository;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\PayoutRepository;
use App\Contracts\Repositories\UserRepository;
use App\Mail\Business\WeeklySummaryMailable;
use App\Models\MarketplaceJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailer;

class WeeklySummaryCommand extends Command
{
    /**
     * @var ApplicationRepository
     */
    private $applicationRepository;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var marketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var PayoutRepository
     */
    private $payoutRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:WeeklySummary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a weekly summary to businesses.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Mailer $mailer,
        BusinessRepository $businessRepository,
        UserRepository $userRepository,
        ApplicationRepository $applicationRepository,
        MarketplaceJobRepository $marketplaceJobRepository,
        PayoutRepository $payoutRepository
    )
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->applicationRepository = $applicationRepository;
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->payoutRepository = $payoutRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $businesses = $this->businessRepository->get();
        $lastWeek = Carbon::today()->subDays(7);

        foreach ($businesses as $business) {
            $businessOwner = $this->userRepository->findWhere(['id' => $business->owner_id])->first();
            $weeklyApplicants = $this->applicationRepository->findWhere(['business_id' => $business->id])->where('created_at', '>=', $lastWeek)->count();
            $weeklyJobsPosted = $this->marketplaceJobRepository->findWhere(['business_id' => $business->id])->where('created_at', '>=', $lastWeek)->count();
            $weeklyJobsCompleted = $this->marketplaceJobRepository->findWhere(['business_id' => $business->id])->where('status_id', 5)->where('created_at', '>=', $lastWeek)->count();

            $marketplaceJobs = $business->marketplaceJobs()->with('payment')->get();
            $weeklyPayout = $marketplaceJobs->sum(function (MarketplaceJob $marketplaceJob) {
                return $marketplaceJob->payment()->where('created_at', '>=', Carbon::today()->subDays(7))->sum('amount');
            });

            $this->mailer->to($businessOwner->email)->send(new WeeklySummaryMailable($businessOwner, $business, $weeklyApplicants, $weeklyJobsPosted, $weeklyJobsCompleted, $weeklyPayout));
        }

    }
}
