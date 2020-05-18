<?php

namespace App\Http\Controllers\Auth;

use App\Annotation\BodyParam;
use App\Annotation\Group;
use App\Annotation\Meta;
use App\Annotation\ResponseExample;
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

/**
 * @Group(name="Register", description="These routes belong are responsible for registration processes.")
 */
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
     * @Meta(name="User Register", description="Create a new account with Gigwerk.", href="register")
     * @BodyParam(name="first_name", type="string", status="requred", description="The first name of the user.", example="John")
     * @BodyParam(name="last_name", type="string", status="requred", description="The last name of the user.", example="Doe")
     * @BodyParam(name="username", type="string", status="requred", description="The username of the user.", example="test_user")
     * @BodyParam(name="email", type="string", status="requred", description="The email of the user.", example="test_user")
     * @BodyParam(name="phone", type="string", status="requred", description="The phone number of the user.", example="555-555-0125")
     * @BodyParam(name="password", type="string", status="required", description="The password for the user.", example="password1")
     * @ResponseExample(status=201, example="responses/register/register-201.json")
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
        ]);

        $data = $request->all();

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
