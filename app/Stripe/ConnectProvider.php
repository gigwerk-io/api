<?php


namespace App\Stripe;


use App\Contracts\Stripe\Connect;
use App\Enum\Billing\Rate;
use GuzzleHttp\Client;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Str;
use Stripe\Account;
use Stripe\Balance;
use Stripe\Stripe;
use Stripe\Transfer;

class ConnectProvider implements Connect
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var RedisManager
     */
    private $redis;

    /**
     * BillingProvider constructor.
     * @param Client $client
     * @param RedisManager $redis
     */
    public function __construct(Client $client, RedisManager $redis)
    {
        Stripe::setApiKey(config('stripe.secret'));
        $this->client = $client;
        $this->redis = $redis;
    }

    /**
     * Create a Stripe connect account from a temporary code.
     *
     * @param string $code
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createAccount(string $code)
    {
        $request = $this->client->request("POST", "token", [
            'form_params' => [
                'client_secret' => config('stripe.secret'),
                'code' => $code,
                'grant_type' => 'authorization_code'
            ]
        ]);
        return json_decode($request->getBody()->getContents());
    }

    /**
     * Create a login link for a user to view their stripe account.
     *
     * @param string $stripe_connect_id
     * @return mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createLoginLink(string $stripe_connect_id)
    {
        $account = Account::retrieve($stripe_connect_id);
        $link = $account->login_links->create();
        return $link->url;
    }

    /**
     * View the available balance of a Stripe account.
     *
     * @param string $stripeConnectId
     * @return float|int
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function currentBalance(string $stripeConnectId)
    {
        $balance = Balance::retrieve(['stripe_account' => $stripeConnectId]);
        return centsToDollars($balance->available[0]->amount);
    }

    /**
     * Create a payout to a Stripe account.
     *
     * @param string $stripeConnectId
     * @param float $price
     * @return mixed|Transfer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createPayout(string $stripeConnectId, float $price)
    {
        return Transfer::create(array(
            "amount" => dollarsToCents($price * Rate::STANDARD),
            "currency" => "usd",
            "source_transaction" => null,
            "destination" => $stripeConnectId
        ));
    }

    /**
     * Make the OAuth url to create a standard connect account.
     *
     * @param int $id
     * @return mixed|string
     */
    public function createStandardUrl(int $id)
    {
        $token = Str::random();
        $this->redis->set($token, $id);

        $standardUrl = str_replace('{client_id}', config('stripe.connect.client_id'), config('stripe.connect.standard'));
        $standardUrl = str_replace( '{uri}', config('stripe.connect.redirect_uri'), $standardUrl);
        return str_replace( '{state}', $token, $standardUrl);
    }

    /**
     * Make the OAuth url to create a express connect account.
     *
     * @param int $id
     * @return mixed|string
     */
    public function createExpressUrl(int $id)
    {
        $token = Str::random();
        $this->redis->set($token, $id);

        $expressUrl = str_replace('{client_id}', config('stripe.connect.client_id'), config('stripe.connect.express'));
        $expressUrl = str_replace( '{uri}', config('stripe.connect.redirect_uri'), $expressUrl);
        return str_replace( '{state}', $token, $expressUrl);
    }

    /**
     * Reverse a transfer made to a user.
     *
     * @param string $token
     * @return mixed|\Stripe\TransferReversal
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function reversePayout(string $token)
    {
        return Transfer::createReversal($token);
    }

}
