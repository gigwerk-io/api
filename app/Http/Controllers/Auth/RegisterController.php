<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Business\RegisteredBusinessMailable;
use App\Mail\Business\UserAppliedMailable;
use App\Notifications\Business\UserAppliedNotification;
use Illuminate\Mail\Mailer;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Geolocation\Geolocation;
use App\Contracts\Repositories\ApplicationRepository;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use App\Events\User\Registered;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\BusinessRegisterRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\Business;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    /**
     * @var Geolocation
     */
    private $geolocation;

    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(
        Hasher $hasher,
        Dispatcher $eventDispatcher,
        UserRepository $userRepository,
        BusinessRepository $businessRepository,
        ApplicationRepository $applicationRepository,
        Geolocation $geolocation,
        Mailer $mailer
    )
    {
        $this->hasher = $hasher;
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->applicationRepository = $applicationRepository;
        $this->geolocation = $geolocation;
        $this->mailer = $mailer;
    }

    /**
     * @Meta(name="Create User", description="Create a new account with Gigwerk.", href="register-user")
     * @BodyParam(name="first_name", type="string", status="requred", description="The first name of the user.", example="John")
     * @BodyParam(name="last_name", type="string", status="requred", description="The last name of the user.", example="Doe")
     * @BodyParam(name="username", type="string", status="requred", description="The username of the user.", example="test_user")
     * @BodyParam(name="email", type="string", status="requred", description="The email of the user.", example="test_user")
     * @BodyParam(name="phone", type="string", status="requred", description="The phone number of the user.", example="555-555-0125")
     * @BodyParam(name="password", type="string", status="required", description="The password for the user.", example="password1")
     * @ResponseExample(status=201, example="responses/auth/register/user.registration-201.json")
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function userRegistration(UserRegisterRequest $request)
    {
        $data = $request->all();

        $data['password'] = $this->hasher->make($request->password);
        $data['phone'] = "+1" . preg_replace('/\D+/', '', $request->phone);

        $user = $this->userRepository->create($data);
        $user->profile()->create();


        $this->eventDispatcher->dispatch(new Registered($user));

        $user->load(['profile']);

        return ResponseFactory::success(
            'User has been successfully registered.',
            ['user' => $user],
            Response::HTTP_CREATED
        );
    }


    /**
     * @Meta(name="Create Business", description="Create a business account with Gigwerk.", href="register-business")
     * @BodyParam(name="name", type="string", status="required", description="The name of the business", example="507 Outdoor Management")
     * @BodyParam(name="subdomain_prefix", type="string", status="required", description="The subdomain for the business", example="507outdoor")
     * @BodyParam(name="street_address", type="string", status="required", description="The address of the job location", example="123 Main St NE")
     * @BodyParam(name="city", type="string", status="required", description="The city of the job location.", example="Rochester")
     * @BodyParam(name="state", type="string", status="required", description="The state of the job location.", example="MN")
     * @BodyParam(name="zip", type="string", status="required", description="The zip code of the job location.", example="55901")
     * @ResponseExample(status=201, example="responses/auth/register/business.registration-201.json")
     *
     * @param BusinessRegisterRequest $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function businessRegistration(BusinessRegisterRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $request->all();
        $data['owner_id'] = $user->id;
        $data['unique_id'] = Str::uuid();
        /** @var Business $business */

        $business = $user->businesses()->create($data, ['role_id' => Role::VERIFIED_FREELANCER]);

        $location = [
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip
        ];

        $coords = $this->geolocation->geoLocate($location);
        $location['lat'] = $coords->lat;
        $location['long'] = $coords->lng;

        $business->location()->create($location);
        $business->profile()->create();

        $business->load(['profile', 'location']);

        $userBusiness = $this->businessRepository->findByField('name', $request->name)->first();



        return ResponseFactory::success(
            'Your business has been created',
            $business,
            Response::HTTP_CREATED
        );
    }


    /**
     * @Meta(name="Join Business", description="Request to join a business marketplace as a worker.", href="join-business")
     * @ResponseExample(status=200, example="responses/auth/register/join.business-200.json")
     * @ResponseExample(status=400, example="responses/auth/register/join.business-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function joinBusiness(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Business $business */
        $business = $this->businessRepository->findByField('unique_id', $request->unique_id)->first();

        $owner = $this->userRepository->findWhere(['id' => $business->owner_id])->first();

        if ($business->users()->where('id', '=', $user->id)->exists()) {
            return ResponseFactory::error('You are already a member of this business marketplace');
        }

        if ($business->applications()->where('user_id', '=', $user->id)->exists()) {
            return ResponseFactory::error('You have already a applied to this business marketplace');
        }

        $user->notify(new UserAppliedNotification($user, $owner, $business));

        $this->mailer->to($owner->email)->send(new UserAppliedMailable($user, $business->unique_id));

        $business->applications()->create(['user_id' => $user->id, 'status_id' => ApplicationStatus::PENDING]);

        return ResponseFactory::success('Your application has been sent');
    }
}
