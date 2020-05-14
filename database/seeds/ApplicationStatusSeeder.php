<?php

use App\Contracts\Repositories\ApplicationStatusRepository;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var ApplicationStatusRepository $applicationStatusRepository */
        $applicationStatusRepository = app()->make(ApplicationStatusRepository::class);
        $data = file_get_contents(database_path('data/application-status.json'));
        $statuses = json_decode($data);
        foreach ($statuses as $status){
            $applicationStatusRepository->updateOrCreate(['name' => $status]);
        }
    }
}
