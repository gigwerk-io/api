<?php

use App\Contracts\Repositories\DeploymentStatusRepository;
use Illuminate\Database\Seeder;

class DeploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var DeploymentStatusRepository $deploymentStatusRepository */
        $deploymentStatusRepository = app()->make(DeploymentStatusRepository::class);
        $data = file_get_contents(database_path('data/deployment-status.json'));
        $statuses = json_decode($data);
        foreach ($statuses as $status){
            $deploymentStatusRepository->create(['name' => $status]);
        }
    }
}
