<?php

use App\Contracts\Repositories\ProposalStatusRepository;
use Illuminate\Database\Seeder;

class ProposalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        /** @var ProposalStatusRepository $proposalStatusRepository */
        $proposalStatusRepository = app()->make(ProposalStatusRepository::class);
        $data = file_get_contents(database_path('data/proposal-status.json'));
        $statuses = json_decode($data);
        foreach ($statuses as $status){
            $proposalStatusRepository->updateOrCreate(['name' => $status]);
        }
    }
}
