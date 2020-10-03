<?php

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Stripe\Billing;
use App\Contracts\Stripe\Connect;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Models\MarketplaceJob;
use App\Notifications\Marketplace\CustomerReviewedWorkerNotification;
use App\Notifications\Marketplace\WorkerAcceptedJobNotification;
use App\Notifications\Marketplace\WorkerArrivedNotification;
use App\Notifications\Marketplace\WorkerCompletedJobNotification;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Tests\Factories\MarketplaceJobFactory;
use Tests\Factories\MarketplaceLocationFactory;

class DevMarketplaceJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // One requested job
        MarketplaceJobFactory::new()
            ->withAttributes(['customer_id' => 1, 'business_id' => 1])
            ->withLocation(MarketplaceLocationFactory::new())();

        // One pending job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 1,
                'business_id' => 1,
                'status_id' => Status::PENDING_APPROVAL,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob){
                $marketplaceJob->proposals()->create([
                    'user_id' => 2, // primary worker
                    'status_id' => ProposalStatus::PENDING
                ]);

                $marketplaceJob->customer->notify(new WorkerAcceptedJobNotification($marketplaceJob));
                $marketplaceJob->business->notify(new WorkerAcceptedJobNotification($marketplaceJob));
            })();



        // One approved job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 1,
                'business_id' => 1,
                'status_id' => Status::APPROVED,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob){
                $proposal = $marketplaceJob->proposals()->create([
                    'user_id' => 2, // primary worker
                    'status_id' => ProposalStatus::APPROVED
                ]);

                $proposal->user->notify(new CustomerReviewedWorkerNotification($marketplaceJob));
            })();

        // One in progress job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 1,
                'business_id' => 1,
                'status_id' => Status::IN_PROGRESS,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob) {
                $marketplaceJob->proposals()->create([
                    'user_id' => 2, // primary worker
                    'status_id' => ProposalStatus::APPROVED,
                    'arrived_at' => Carbon::today()->toDateTimeString()
                ]);

                // create payment
                $charge = app()->make(Billing::class)->createCharge(
                    $marketplaceJob->customer->primaryPaymentMethod->stripe_customer_id,
                    $marketplaceJob->price,
                    $marketplaceJob->description
                );
                $marketplaceJob->payment()->create([
                    'user_id' => $marketplaceJob->customer_id,
                    'amount' => $marketplaceJob->price,
                    'stripe_token' => $charge->id // stripe charge id
                ]);

                $marketplaceJob->customer->notify(new WorkerArrivedNotification($marketplaceJob));
                $marketplaceJob->business->notify(new WorkerArrivedNotification($marketplaceJob));
            })();


        // One freelancer complete
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 1,
                'business_id' => 1,
                'status_id' => Status::COMPLETE,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob) {
                $marketplaceJob->proposals()->create([
                    'user_id' => 2, // primary worker
                    'status_id' => ProposalStatus::APPROVED,
                    'arrived_at' => Carbon::today()->toDateTimeString(),
                    'completed_at' => Carbon::today()->subHour()->toDateTimeString(),
                    'rating' => 5,
                    'review' => 'Good job!'
                ]);

                // create payment
                $charge = app()->make(Billing::class)->createCharge(
                    $marketplaceJob->customer->primaryPaymentMethod->stripe_customer_id,
                    $marketplaceJob->price,
                    $marketplaceJob->description
                );
                $marketplaceJob->payment()->create([
                    'user_id' => $marketplaceJob->customer_id,
                    'amount' => $marketplaceJob->price,
                    'stripe_token' => $charge->id // stripe charge id
                ]);

                $worker = app()->make(UserRepository::class)->find(2);

                // create transfer
                $transfer = app()->make(Connect::class)->createPayout(
                    $worker->payoutMethod->stripe_connect_id,
                    $marketplaceJob->price
                );

                $marketplaceJob->payout()->create([
                    'user_id' => $marketplaceJob->customer_id,
                    'amount' => centsToDollars($transfer->amount),
                    'stripe_token' => $transfer->id // stripe transfer id
                ]);

            })->create();

        // One requested job
        MarketplaceJobFactory::new()
            ->withAttributes(['customer_id' => 5, 'business_id' => 2])
            ->withLocation(MarketplaceLocationFactory::new())();

        // One pending job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 5,
                'business_id' => 2,
                'status_id' => Status::PENDING_APPROVAL,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob){
                $marketplaceJob->proposals()->create([
                    'user_id' => 6, // primary worker
                    'status_id' => ProposalStatus::PENDING
                ]);

                $marketplaceJob->customer->notify(new WorkerAcceptedJobNotification($marketplaceJob));
                $marketplaceJob->business->notify(new WorkerAcceptedJobNotification($marketplaceJob));
            })();

        // One approved job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 5,
                'business_id' => 2,
                'status_id' => Status::APPROVED,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob){
                $proposal = $marketplaceJob->proposals()->create([
                    'user_id' => 6, // primary worker
                    'status_id' => ProposalStatus::APPROVED
                ]);

                $proposal->user->notify(new CustomerReviewedWorkerNotification($marketplaceJob));
            })();

        // One in progress job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 5,
                'business_id' => 2,
                'status_id' => Status::IN_PROGRESS,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob) {
                $marketplaceJob->proposals()->create([
                    'user_id' => 6, // primary worker
                    'status_id' => ProposalStatus::APPROVED,
                    'arrived_at' => Carbon::today()->toDateTimeString()
                ]);

                // create payment
                $charge = app()->make(Billing::class)->createCharge(
                    $marketplaceJob->customer->primaryPaymentMethod->stripe_customer_id,
                    $marketplaceJob->price,
                    $marketplaceJob->description
                );
                $marketplaceJob->payment()->create([
                    'user_id' => $marketplaceJob->customer_id,
                    'amount' => $marketplaceJob->price,
                    'stripe_token' => $charge->id // stripe charge id
                ]);

                $marketplaceJob->customer->notify(new WorkerArrivedNotification($marketplaceJob));
                $marketplaceJob->business->notify(new WorkerArrivedNotification($marketplaceJob));
//                $marketplaceJob->business->notify(new \App\Notifications\Business\BusinessApprovedNotification($marketplaceJob->business));
            })();
    }
}
