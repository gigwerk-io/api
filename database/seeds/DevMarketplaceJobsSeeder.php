<?php

use App\Contracts\Stripe\Billing;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Models\MarketplaceJob;
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
            ->withAttributes(['customer_id' => 2, 'business_id' => 1])
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
            })();

        // One approved job
        MarketplaceJobFactory::new()
            ->withAttributes([
                'customer_id' => 1,
                'business_id' => 1,
                'status_id' => Status::APPROVED,
            ])->withLocation(MarketplaceLocationFactory::new())
            ->afterCreating(function (MarketplaceJob $marketplaceJob){
                $marketplaceJob->proposals()->create([
                    'user_id' => 2, // primary worker
                    'status_id' => ProposalStatus::APPROVED
                ]);
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
            })();
    }
}
