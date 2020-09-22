<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\UserRoleRepository;
use App\Enum\Billing\Plan;
use App\Factories\ResponseFactory;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Meta;

class DataController extends Controller
{

    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->all();
        return ResponseFactory::success(
            'Showing categories',
            $categories
        );
    }


    public function roles(UserRoleRepository $userRoleRepository)
    {
        $roles = $userRoleRepository->all();
        return ResponseFactory::success(
            'Showing roles',
            $roles
        );
    }


    public function businesses(BusinessRepository $businessRepository)
    {
        $businesses = $businessRepository->with(['profile', 'location', 'businessApp'])->all();

        return ResponseFactory::success(
            'Show all businesses',
            $businesses
        );
    }

    public function subscriptions()
    {
        return ResponseFactory::success('Show subscription plans', Plan::toCollection());
    }
}
