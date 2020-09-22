<?php

use App\Enum\Billing\Plan;
use App\Enum\User\Role;
use App\Enums\ApplicationStatus;
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
        $businessAdminOne = UserFactory::new()->withAttributes([
            'username' => 'admin_one',
            'email' => 'admin_one@mail.com',
            'first_name' => 'Peter',
            'last_name' => 'Weyland'
        ])
            ->withProfile(UserProfileFactory::new()->make([
                'image' => 'https://gigwerk-disk.s3.amazonaws.com/seed/peter-weyland.png',
                'description' => 'Founder and owner of the Weyland Corporation'
            ]))
            ->withPaymentMethods(PaymentMethodFactory::new())
            ->create();

        $businessOne = BusinessFactory::new()->withAttributes([
            'name' => 'Weyland-Yutani Corporation',
            'subdomain_prefix' => 'weyland-yutani',
            'unique_id' => 'ea11187b-fba5-31c8-87b4-84928c0334d6'
        ])
            ->withProfile(BusinessProfileFactory::new()->make([
                'image' => 'https://gigwerk-disk.s3.amazonaws.com/seed/weyland-yutani.png',
                'short_description' => 'Building better worlds',
                'long_description' => 'Primarily a technology supplier, manufacturing synthetics, spaceships and computers for a wide range of industrial and commercial clients'
            ]))
            ->withLocation(BusinessLocationFactory::new())
            ->afterCreating(function (Business $business) use ($businessAdminOne, $stripe) {
                $businessAdminOne->businesses()->attach($business, ['role_id' => Role::CUSTOMER]);
                $domain = sprintf("https://%s-%s.%s",$business->subdomain_prefix, app()->environment(), config('app.url_suffix'));
                $business->businessApp()->create(['domain' => $domain]);
                $business->integration()->create();
                $business->form()->create([
                    'form' => json_decode(
                        file_get_contents(database_path('data/applicant-form.json'))
                    )
                ]);
                $paymentMethod = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => [
                        'number' => '4242424242424242',
                        'exp_month' => 6,
                        'exp_year' => 2021,
                        'cvc' => '314',
                    ],
                ]);


                $business->createOrGetStripeCustomer(['name' => $business->name, 'description' => 'Weyland-Yutani Corporation']);
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
            ->withAttributes(['username' => 'worker_one', 'email' => 'worker_one@mail.com'])
            ->afterCreating(function (User $user) use ($businessOne) {
                $businessOne->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending freelancer for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'pending_one', 'email' => 'pending_one@mail.com'])
            ->afterCreating(function (User $user) use ($businessOne) {
                $businessOne->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();;
        // Create a pending application for business one
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'applicant_one'])
            ->afterCreating(function (User $user) use ($businessOne) {
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::NEW
                ]);
            })->create();

        /** @var User $businessAdminTwo */
        $businessAdminTwo = UserFactory::new()->withAttributes(['username' => 'admin_two', 'email' => 'admin_two@mail.com'])
            ->withProfile(UserProfileFactory::new())
            ->withPaymentMethods(PaymentMethodFactory::new())
            ->create();

        $businessTwo = BusinessFactory::new()->withAttributes(['name' => 'Second business LLC', 'subdomain_prefix' => 'second', 'unique_id' => '048d54b7-54fc-3e4e-87c5-d575ff867b84'])
            ->withProfile(BusinessProfileFactory::new()->withAttributes(['image' => 'https://gigwerk-disk.s3.amazonaws.com/second.png']))
            ->withLocation(BusinessLocationFactory::new())
            ->afterCreating(function (Business $business) use ($businessAdminTwo, $stripe) {
                $businessAdminTwo->businesses()->attach($business, ['role_id' => Role::VERIFIED_FREELANCER]);
                $domain = sprintf("https://second-%s.%s", app()->environment(), config('app.url_suffix'));
                $business->businessApp()->create(['domain' => $domain]);
                $business->integration()->create();
                $business->form()->create([
                    'form' => json_decode(
                        file_get_contents(database_path('data/applicant-form.json'))
                    )
                ]);

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
            ->withAttributes(['username' => 'worker_two', 'email' => 'worker_two@mail.com'])
            ->afterCreating(function (User $user) use ($businessTwo) {
                $businessTwo->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending freelancer for business two
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'pending_two', 'email' => 'pending_two@mail.com'])
            ->afterCreating(function (User $user) use ($businessTwo) {
                $businessTwo->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // Create a pending application for business two
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'applicant_two'])
            ->afterCreating(function (User $user) use ($businessTwo) {
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::NEW
                ]);
            })->create();

        // Create a verified freelancer for both businesses
        UserFactory::new()
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->withAttributes(['username' => 'multi_user'])
            ->afterCreating(function (User $user) use ($businessTwo, $businessOne) {
                $businessTwo->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);

                $businessOne->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();
    }
}
