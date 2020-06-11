<?php

namespace App\Http\Controllers\User;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Stripe\Connect;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\QueryParam;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Stripe Connect", description="Stripe connect routes.")
 */
class ConnectController extends Controller
{
    /**
     * @var Connect
     */
    private $connect;

    /**
     * @var RedisManager
     */
    private $redis;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Connect $connect, RedisManager $redis, UserRepository $userRepository)
    {
        $this->connect = $connect;
        $this->redis = $redis;
        $this->userRepository = $userRepository;
    }

    /**
     * @Meta(name="Login to Stripe", href="stripe-login", description="Get a URL to either create or login into a Stripe express account.")
     * @ResponseExample(status=200, example="responses/user/connect/stripe.user.login-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        if (!$user->payoutMethod()->exists()) {
            return ResponseFactory::success('Creating express OAuth URL', ['url' => $this->connect->createExpressUrl($user->id)]);
        }

        return ResponseFactory::success('Get express OAuth URL', ['url' => $this->connect->createLoginLink($user->payoutMethod->stripe_connect_id)]);
    }

    /**
     * @Meta(name="Save Stripe Account", href="save-stripe", description="Create Stripe express account so worker can get paid.")
     * @QueryParam(name="state", type="string", status="required", description="The token used to identify the user.")
     * @QueryParam(name="code", type="string", status="required", description="The temporary stripe token for OAuth confirmation.")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'state' => 'required',
            'code' => 'required'
        ]);

        $id = $this->redis->get($request->state);

        if (is_null($id)) {
            return ResponseFactory::error('Something went wrong. Please try again later.');
        }

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (is_null($user)) {
            return ResponseFactory::error('The user was not found', null, 404);
        }

        $account = $this->connect->createAccount($request->account);
        $user->payoutMethod()->create(['stripe_connect_id' => $account->stripe_user_id]);

        return ResponseFactory::success('Your account has been saved.');
    }
}
