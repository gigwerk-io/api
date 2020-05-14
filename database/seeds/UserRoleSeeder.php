<?php

use App\Contracts\Repositories\UserRoleRepository;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        /** @var UserRoleRepository $userRoleRepository */
        $userRoleRepository = app()->make(UserRoleRepository::class);
        $data = file_get_contents(database_path('data/user-roles.json'));
        $roles = json_decode($data);
        foreach ($roles as $role){
            $userRoleRepository->updateOrCreate(['name' => $role]);
        }
    }
}
