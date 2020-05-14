<?php

use App\Contracts\Repositories\CategoryRepository;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app()->make(CategoryRepository::class);
        $data = file_get_contents(database_path('data/categories.json'));
        $categories = json_decode($data, true);
        foreach ($categories as $category){
            $categoryRepository->updateOrCreate($category);
        }
    }
}
