<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

/**
 * @group Auth-Login
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

    /**
     * LoginController constructor.
     * @param Hasher $hasher
     * @param UserRepository $userRepository
     */
    public function __construct(Hasher $hasher, UserRepository $userRepository, BusinessRepository $businessRepository)
    {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * @api {post} /login Login to a user account
     * @apiName Login
     * @apiGroup Auth
     * @apiParam {String} [username]          Mandatory The username or email of the user.
     * @apiParam {String} [password]          Mandatory The password of the user.
     *
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
            'business_id' => ['required','exists:businesses,unique_id']
        ]);

        $user = $this->userRepository->findByUsernameOrEmail($request->username);

        $business = $this->businessRepository->findByField('unique_id', $request->business_id)->first();

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

        $user->business = $user->businesses()->where('business_id', '=', $business->id)->first();

        if(is_null($user->business)){
            return ResponseFactory::error('You do not have access to this business.', null, 403);
        }

        $token = $user->createToken($business->subdomain_prefix . ':login');



        return ResponseFactory::success(
            'User has logged in',
            ['user' => $user, 'token' => $token->plainTextToken],
        );
    }

    /**
     * Logout
     * Log a user out.
     * @responseFile 200 responses/auth/login/logout-200.json
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
     * Token Validation
     * Validate a user has a valid token
     * @responseFile 200 responses/auth/login/token.validation-200.json
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
