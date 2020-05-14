<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Repositories\ApplicationRepository;
use App\Contracts\Repositories\BusinessInvitationRepository;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use App\Events\User\UserHasRegistered;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * @var ApplicationRepository
     */
    private $applicationRepository;

    /**
     * RegisterController constructor.
     * @param Hasher $hasher
     * @param Dispatcher $eventDispatcher
     * @param UserRepository $userRepository
     * @param BusinessRepository $businessRepository
     */
    public function __construct(
        Hasher $hasher,
        Dispatcher $eventDispatcher,
        UserRepository $userRepository,
        BusinessRepository $businessRepository,
        ApplicationRepository $applicationRepository
    )
    {
        $this->hasher = $hasher;
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * User Registration
     * Register a new user.
     * @bodyParam first_name string required The first name of the user. Example: John
     * @bodyParam last_name string required The last name of the user. Example: Doe
     * @bodyParam username string required The username of the user. Example: test_user
     * @bodyParam email string required The email of the user. Example: test_user@email.com
     * @bodyParam phone string required The phone number of the user. Example: (901) 555-0125
     * @bodyParam businesses_id string optional The unique of the business. Example: 49268990-a172-349b-9bdc-785197d80faf
     * @bodyParam freelancer boolean optional Determine if user is freelancer or customer. Ex: true
     * @bodyParam password string required The password for the user. Example: secret
     * @responseFile 201 responses/auth/register/register-201.json
     * @responseFile 422 responses/auth/register/register-422.json
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userRegistration(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required'],
            'password' => ['required'],
            'freelancer' => ['bool'],
        ]);

        $business = $this->businessRepository->findWhere(['unique_id' => $request->business_id])->first();

        $data = $request->all();
        if($request->has('freelancer')){
            // default role is customer
            $data['role_id'] = ($request->freelancer) ? Role::PENDING_FREELANCER : Role::CUSTOMER;
        }

        $data['password'] = $this->hasher->make($request->password);
        $data['phone'] = "+1" . preg_replace('/\D+/', '', $request->phone);

        $user = $this->userRepository->create($data);
        $user->profile()->create();

        // Create application
        $this->applicationRepository->create(['business_id' => $business->id, 'user_id' => $user->id, 'status_id' => ApplicationStatus::PENDING]);

        $this->eventDispatcher->dispatch(new UserHasRegistered($user));

        return ResponseFactory::success(
            'User has been successfully registered.',
            null,
            Response::HTTP_CREATED
        );
    }

    public function businessRegistration(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'subdomain_prefix' => ['required', 'unique:businesses,subdomain_prefix'],
            'short_description' => ['required']
        ]);
    }

    public function joinBusiness(Request $request)
    {
        $this->validate($request, [
            'business_id' => ['required', 'unique:businesses,unique_id'],
            'is_freelancer' => ['required', 'bool']
        ]);


    }
}
