<?php

use App\Contracts\Repositories\JobStatusRepository;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        /** @var JobStatusRepository $jobStatusRepository */
        $jobStatusRepository = app()->make(JobStatusRepository::class);
        $data = file_get_contents(database_path('data/job-status.json'));
        $statuses = json_decode($data);
        foreach ($statuses as $status){
            $jobStatusRepository->updateOrCreate(['name' => $status]);
        }
    }
}
