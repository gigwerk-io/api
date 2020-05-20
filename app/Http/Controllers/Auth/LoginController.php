<?php

namespace App\Http\Controllers\Auth;

use App\Annotation\BodyParam;
use App\Annotation\Group;
use App\Annotation\Meta;
use App\Annotation\ResponseExample;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

/**
 * @Group(name="Login", description="These routes belong are responsible for creating deleting and validating login/session tokens.")
 */
class LoginController extends Controller
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    public function __construct(Hasher $hasher, UserRepository $userRepository, BusinessRepository $businessRepository)
    {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * @Meta(name="Default Login", description="Login to a user account for the website or dashboard.", href="basic-login")
     * @BodyParam(name="username", type="string", status="required", description="The username or email of the user", example="business_admin")
     * @BodyParam(name="password", type="string", status="required", description="The password for the user", example="password")
     * @ResponseExample(status=200, example="responses/auth/login/login-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = $this->userRepository->findByUsernameOrEmail($request->username);

        if (is_null($user)) {
            return ResponseFactory::error(
                'Incorrect username or password.',
                null,
                401
            );
        }

        if (!$this->hasher->check($request->password, $user->password)) {
            return ResponseFactory::error(
                'Incorrect username or password.',
                null,
                401
            );
        }

        $user->load(['profile']);

        $token = $user->createToken('login');

        return ResponseFactory::success(
            'User has logged in',
            ['user' => $user, 'token' => $token->plainTextToken],
        );
    }


    /**
     * @Meta(name="Business App Login", href="business-login", description="Login to a businesses marketplace app.")
     * @BodyParam(name="username", type="string", status="required", description="The username or email of the user", example="business_worker")
     * @BodyParam(name="password", type="string", status="required", description="The password for the user", example="password")
     * @ResponseExample(status=200, example="responses/auth/login/business.login-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function businessLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $uuid = $request->unique_id;

        // Checks if a users is apart of the business
        $user = $this->userRepository->whereHas('businesses', function ($query) use ($uuid) {
            return $query->where('unique_id', '=', $uuid);
        })->findByUsernameOrEmail($request->username);

        if (is_null($user)) {
            return ResponseFactory::error(
                'Incorrect username or password.',
                null,
                401
            );
        }

        $user->load(['profile']);

        $token = $user->createToken('login', [$uuid]);

        return ResponseFactory::success(
            'User has logged in',
            ['user' => $user, 'token' => $token->plainTextToken],
        );
    }

    /**
     * @Meta(name="End Session", href="logout", description="Destroy a user session.")
     * @ResponseExample(status=200, example="responses/auth/login/logout-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        return ResponseFactory::success(
            'User has been logged out.',
            null
        );
    }

    /**
     * @Meta(name="Validate Session", href="validate", description="Check if a users session token is still valid.")
     * @ResponseExample(status=200, example="responses/auth/login/validate-200.json")
     * @ResponseExample(status=400, example="responses/auth/login/validate-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function tokenValidation(Request $request)
    {
        if (is_null($request->user())) {
            return ResponseFactory::error(
                'Token is not valid.',
                ['validToken' => false]
            );
        }

        return ResponseFactory::success(
            'Token is valid.',
            ['validToken' => true]
        );
    }

    /**
     * @Meta(name="Validate Business Token", href="business-validate", description="Check if a users token has access to a specific business.")
     * @ResponseExample(status=200, example="responses/auth/login/business.validate-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function businessTokenValidation(Request $request)
    {
        $business = $request->get('business');
        /** @var User $user */
        $user = $request->user();

        if (!$user->tokenCan($business->unique_id)) {
            return ResponseFactory::error('You do not have access to this business.', null, 403);
        }

        return ResponseFactory::success(
            'You have access to this business.',
            ['validToken' => true]
        );
    }
}
