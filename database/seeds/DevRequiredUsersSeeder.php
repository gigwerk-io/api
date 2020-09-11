<?php

use App\Enum\Billing\Plan;
use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Stripe\StripeClient;
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
        /** @var StripeClient $stripe */
        $stripe = app()->make(StripeClient::class);

        /** @var User $businessAdminOne */
        $businessAdminOne = UserFactory::new()->withAttributes(['username' => 'admin_one'])
            ->withProfile(UserProfileFactory::new())
            ->withPaymentMethods(PaymentMethodFactory::new())
            ->create();

        $businessOne = BusinessFactory::new()->withAttributes(['name' => 'First business Inc.', 'subdomain_prefix' => 'first', 'unique_id' => 'ea11187b-fba5-31c8-87b4-84928c0334d6'])
            ->withProfile(BusinessProfileFactory::new())
            ->withLocation(BusinessLocationFactory::new())
            ->afterCreating(function (Business $business) use ($businessAdminOne, $stripe){
                $businessAdminOne->businesses()->attach($business, ['role_id' => Role::CUSTOMER]);
                $domain = sprintf("https://first-%s.%s", app()->environment(), config('app.url_suffix'));
                $business->businessApp()->create(['domain' => $domain]);
                $business->integration()->create();
                $paymentMethod = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => [
                        'number' => '4242424242424242',
                        'exp_month' => 6,
                        'exp_year' => 2021,
                        'cvc' => '314',
                    ],
                ]);


                $business->createOrGetStripeCustomer(['name' => $business->name, 'description' => 'The First business Inc of America']);
                $business->addPaymentMethod($paymentMethod);
                $business->updateDefaultPaymentMethod($paymentMethod);

                $paymentMethod2 = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => [
                        'number' => '5200828282828210',
                        'exp_month' => 03,
                        'exp_year' => 2022,
                        'cvc' => '123',
                    ],
                ]);
                $business->addPaymentMethod($paymentMethod2);

                $business->newSubscription(Plan::PRO['name'], Plan::PRO['id'])->create();
            })
            ->create(['owner_id' => $businessAdminOne->id]);



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

        $businessTwo = BusinessFactory::new()->withAttributes(['name' => 'Second business LLC', 'subdomain_prefix' => 'second', 'unique_id' => '048d54b7-54fc-3e4e-87c5-d575ff867b84'])
            ->withProfile(BusinessProfileFactory::new()->withAttributes(['image' => 'https://gigwerk-disk.s3.amazonaws.com/second.png']))
            ->withLocation(BusinessLocationFactory::new())
            ->afterCreating(function (Business $business) use ($businessAdminTwo, $stripe){
                $businessAdminTwo->businesses()->attach($business, ['role_id' => Role::VERIFIED_FREELANCER]);
                $domain = sprintf("https://second-%s.%s", app()->environment(), config('app.url_suffix'));
                $business->businessApp()->create(['domain' => $domain]);
                $business->integration()->create();

                $paymentMethod = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => [
                        'number' => '5200828282828210',
                        'exp_month' => 03,
                        'exp_year' => 2022,
                        'cvc' => '123',
                    ],
                ]);

                $business->createOrGetStripeCustomer(['name' => $business->name, 'description' => 'The Second business LLC of America']);
                $business->addPaymentMethod($paymentMethod);
                $business->updateDefaultPaymentMethod($paymentMethod);

                $business->newSubscription(Plan::STANDARD['name'], Plan::STANDARD['id'])->create();
            })
            ->create(['owner_id' => $businessAdminTwo->id]);

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

        // Create a verified freelancer for both businesses
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'multi_user'])
            ->afterCreating(function (User $user) use ($businessTwo, $businessOne){
                $businessTwo->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);

                $businessOne->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status_id' => ApplicationStatus::APPROVED
                ]);
            })->create();
    }
}
