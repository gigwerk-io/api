<?php

use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tests\Factories\BusinessFactory;
use Tests\Factories\BusinessLocationFactory;
use Tests\Factories\BusinessProfileFactory;
use Tests\Factories\PaymentMethodFactory;
use Tests\Factories\PayoutMethodFactory;
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
        /** @var User $businessAdminOne */
        $businessAdminOne = UserFactory::new()->withAttributes(['username' => 'admin_one'])
            ->withProfile(UserProfileFactory::new())
            ->withPaymentMethods(PaymentMethodFactory::new())
            ->create();

        $businessOne = BusinessFactory::new()->withAttributes(['name' => 'First Business Inc.', 'subdomain_prefix' => 'demo'])
            ->withProfile(BusinessProfileFactory::new()->withAttributes())
            ->withLocation(BusinessLocationFactory::new())
            ->make(['owner_id' => $businessAdminOne->id]);

        $businessOne = $businessAdminOne->businesses()->save($businessOne, ['role_id' => Role::VERIFIED_FREELANCER]);

        // Create a verified freelancer for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'worker_one'])
            ->afterCreating(function (User $user) use ($businessOne){
                $businessOne->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending freelancer for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'pending_one'])
            ->afterCreating(function (User $user) use ($businessOne){
                $businessOne->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);
            })->create();;
        // Create a pending application for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'applicant_one'])
            ->afterCreating(function (User $user) use ($businessOne){
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::PENDING
                ]);
            })->create();

        /** @var User $businessAdminTwo */
        $businessAdminTwo = UserFactory::new()->withAttributes(['username' => 'admin_two'])
            ->withProfile(UserProfileFactory::new())
            ->withPaymentMethods(PaymentMethodFactory::new())
            ->create();

        $businessTwo = BusinessFactory::new()->withAttributes(['name' => 'Second Business LLC', 'subdomain_prefix' => 'test'])
            ->withProfile(BusinessProfileFactory::new()->withAttributes())
            ->withLocation(BusinessLocationFactory::new())
            ->make(['owner_id' => $businessAdminTwo->id]);

        $businessTwo = $businessAdminTwo->businesses()->save($businessTwo, ['role_id' => Role::VERIFIED_FREELANCER]);

        // Create a verified freelancer for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'worker_two'])
            ->afterCreating(function (User $user) use ($businessTwo){
                $businessTwo->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending freelancer for business two
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'pending_two'])
            ->afterCreating(function (User $user) use ($businessTwo){
                $businessTwo->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending application for business two
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'applicant_two'])
            ->afterCreating(function (User $user) use ($businessTwo){
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::PENDING
                ]);
            })->create();
    }
}
