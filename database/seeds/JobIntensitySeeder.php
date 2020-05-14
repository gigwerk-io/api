<?php

use App\Contracts\Repositories\JobIntensityRepository;
use Illuminate\Database\Seeder;

class JobIntensitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        /** @var JobIntensityRepository $intensityRepository */
        $intensityRepository = app()->make(JobIntensityRepository::class);
        $data = file_get_contents(database_path('data/intensity.json'));
        $intensities = json_decode($data);
        foreach ($intensities as $intensity){
            $intensityRepository->updateOrCreate(['name' => $intensity]);
        }
    }
}
