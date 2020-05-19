<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DevRequiredUsersSeeder::class);
        $this->call(DevUsersSeeder::class);
        // $this->call(DevMarketplaceJobsSeeder::class);
    }
}
