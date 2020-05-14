<?php


namespace App\Stripe;


use App\Contracts\Stripe\Billing;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Redis\RedisManager;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Token;

class BillingProvider implements Billing
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    /**
     *Create a Stripe customer we can charge later.
     *
     * @param User $user
     * @param string $source
     * @return array|mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCustomer(User $user, string $source)
    {
        $customer = Customer::create(array(
            'source' => $source,
            'email' => $user->email
        ));

        $token = Token::retrieve($source);

        return [$customer, $token];
    }

    /**
     * Create a charge for a user
     *
     * @param string $stripeCustomerId
     * @param float $price
     * @param string $description
     * @return mixed|Charge
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCharge(string $stripeCustomerId, float $price, string $description = '')
    {
        return Charge::create([
            'amount' => dollarsToCents($price), // Stripe uses cents.
            'currency' => 'usd',
            'customer' => $stripeCustomerId,
            'description' => $description
        ]);
    }

    /**
     * Refund a past payment to a customer.
     *
     * @param string $token
     * @param float $amount
     * @return mixed|Refund
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function refundCharge(string $token, float $amount)
    {
        return Refund::create([
            'charge' => $token,
            'amount' => dollarsToCents($amount)
        ]);
    }
}
