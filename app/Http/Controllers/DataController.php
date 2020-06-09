<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\UserRoleRepository;
use App\Factories\ResponseFactory;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Meta;

class DataController extends Controller
{
    /**
     * @Meta(name="Categories", href="categories", description="Show all available categories")
     *
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->all();
        return ResponseFactory::success(
            'Showing categories',
            $categories
        );
    }

    /**
     * @Meta(name="Roles", href="roles", description="Potential user roles within Gigwerk")
     *
     *
     * @param UserRoleRepository $userRoleRepository
     * @return \Illuminate\Http\Response
     */
    public function roles(UserRoleRepository $userRoleRepository)
    {
        $roles = $userRoleRepository->all();
        return ResponseFactory::success(
            'Showing roles',
            $roles
        );
    }
}
