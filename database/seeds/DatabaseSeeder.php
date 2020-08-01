<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApplicationStatusSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(JobIntensitySeeder::class);
        $this->call(JobStatusSeeder::class);
        $this->call(ProposalStatusSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(DeploymentStatusSeeder::class);
        if(app()->environment() != 'production'){
            $this->call(DevSeeder::class);
        }
    }
}
