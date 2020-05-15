<?php

use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use Illuminate\Database\Seeder;
use Tests\Factories\BusinessFactory;
use Tests\Factories\BusinessLocationFactory;
use Tests\Factories\PaymentMethodFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\UserProfileFactory;

class DevRequiredUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create business admin
        $admin = UserFactory::new()->withProfile(UserProfileFactory::new())
            ->create(['username' => 'business_admin']);
        $admin->paymentMethods()->create([
            'stripe_customer_id' => 'cus_FsQcawWaxlmfbs',
            'stripe_card_id' => 'card_1FMflHD2YnIDoaEIqLthZhO8',
            'card_type' => 'Visa',
            'card_last4' => 4242,
            'exp_month' => 12,
            'exp_year' => 2023,
            'default' => true
        ]);

        // Create business
        $business = BusinessFactory::new()->create(['owner_id' => $admin->id]);

        // Attach admin to business
        $business->users()->attach($admin, ['role_id' => Role::VERIFIED_FREELANCER]);

        // Create approved worker and application
        $worker = UserFactory::new()->withProfile(UserProfileFactory::new())->create(['username' => 'business_worker']);
        $business->users()->attach($worker, ['role_id' => Role::VERIFIED_FREELANCER]);
        $business->applications()->create([
            'user_id' => $worker->id,
            'status_id' => ApplicationStatus::APPROVED
        ]);

        // Create pending worker w/ approved application
        $pendingWorker = UserFactory::new()->withProfile(UserProfileFactory::new())->create(['username' => 'business_pending_worker']);
        $business->users()->attach($pendingWorker, ['role_id' => Role::PENDING_FREELANCER]);
        $business->applications()->create([
            'user_id' => $pendingWorker->id,
            'status_id' => ApplicationStatus::APPROVED
        ]);

        // create pending worker w/ pending application
        $pWorker = UserFactory::new()->withProfile(UserProfileFactory::new())->create(['username' => 'business_pending_worker_2']);
        $business->users()->attach($pWorker, ['role_id' => Role::PENDING_FREELANCER]);
        $business->applications()->create([
            'user_id' => $pWorker->id,
            'status_id' => ApplicationStatus::PENDING
        ]);

    }
}
