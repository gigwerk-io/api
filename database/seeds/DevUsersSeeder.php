<?php

use App\Contracts\Repositories\BusinessRepository;
use App\Enum\User\Role;
use App\Enums\ApplicationStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tests\Factories\PayoutMethodFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\UserProfileFactory;

class DevUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businessOne = app()->make(BusinessRepository::class)->find(1);
        $businessTwo = app()->make(BusinessRepository::class)->find(2);

        // 15 Verified Freelancers for business one
        UserFactory::times(15)
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->afterCreating(function (User $user) use($businessOne){
                $businessOne->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessOne->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // 10 Pending Freelancers for business one
        UserFactory::times(10)->withProfile(UserProfileFactory::new())->afterCreating(function (User $user) use($businessOne){
            $businessOne->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
            $businessOne->applications()->create([
                'user_id' => $user->id,
                'status' => ApplicationStatus::APPROVED
            ]);
        })->create();

        // 8 Pending Applicants for business one
        UserFactory::times(8)->withProfile(UserProfileFactory::new())->afterCreating(function (User $user) use($businessOne){
            $businessOne->applications()->create([
                'user_id' => $user->id,
                'status' => ApplicationStatus::NEW
            ]);
        })->create();

        // 15 Verified Freelancers for business two
        UserFactory::times(15)
            ->withProfile(UserProfileFactory::new())
            ->withPayoutMethod(PayoutMethodFactory::new())
            ->afterCreating(function (User $user) use($businessTwo){
                $businessTwo->users()->attach($user, ['role_id' => Role::VERIFIED_FREELANCER]);
                $businessTwo->applications()->create([
                    'user_id' => $user->id,
                    'status' => ApplicationStatus::APPROVED
                ]);
            })->create();

        // 10 Pending Freelancers for business two
        UserFactory::times(10)->withProfile(UserProfileFactory::new())->afterCreating(function (User $user) use($businessTwo){
            $businessTwo->users()->attach($user, ['role_id' => Role::PENDING_FREELANCER]);
            $businessTwo->applications()->create([
                'user_id' => $user->id,
                'status' => ApplicationStatus::APPROVED
            ]);
        })->create();

        // 8 Pending Applicants for business two
        UserFactory::times(8)->withProfile(UserProfileFactory::new())->afterCreating(function (User $user) use($businessTwo){
            $businessTwo->applications()->create([
                'user_id' => $user->id,
                'status' => ApplicationStatus::NEW
            ]);
        })->create();
    }
}
