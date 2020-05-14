<?php


namespace App\Contracts\Stripe;


use App\Models\MarketplaceJob;
use App\Models\User;
use Stripe\Charge;
use Stripe\Refund;

interface Billing
{
    /**
     *Create a Stripe customer we can charge later.
     *
     * @param User $user
     * @param string $source
     * @return array|mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCustomer(User $user, string $source);

    /**
     * Create a charge for a user
     *
     * @param string $stripeCustomerId
     * @param float $price
     * @param string $description
     * @return mixed|Charge
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCharge(string $stripeCustomerId, float $price, string $description = '');

    /**
     * Refund a past payment to a customer.
     *
     * @param string $token
     * @param float $amount
     * @return mixed|Refund
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function refundCharge(string $token, float $amount);
}
