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
     * @Meta(name="Create Session", description="Login to a user account and return a session token.", href="login")
     * @BodyParam(name="username", type="string", status="required", description="The username or email of the user", example="business_admin")
     * @BodyParam(name="password", type="string", status="required", description="The password for the user", example="business_admin")
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
     * @ResponseExample(status=200, example="responses/auth/login/token.validation-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function tokenValidation(Request $request)
    {
        if(is_null($request->user())){
            return ResponseFactory::success(
                'Token is not valid.',
                ['validToken' => false]
            );
        }

        return ResponseFactory::success(
            'Token is valid.',
            ['validToken' => true]
        );
    }
}
