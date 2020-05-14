<?php


namespace App\Contracts\Stripe;


use App\Models\Business;
use App\Models\User;
use Stripe\Transfer;

interface Connect
{
    /**
     * Create a Stripe connect account from a temporary code.
     *
     * @param string $code
     * @return mixed
     */
    public function createAccount(string $code);

    /**
     * Create a login link for a user to view their stripe account.
     *
     * @param string $stripe_connect_id
     * @return mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createLoginLink(string $stripe_connect_id);

    /**
     * View the available balance of a Stripe account.
     *
     * @param string $stripeConnectId
     * @return float|int
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function currentBalance(string $stripeConnectId);

    /**
     * Create a payout to a Stripe account.
     *
     * @param string $stripeConnectId
     * @param float $price
     * @return mixed|Transfer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createPayout(string $stripeConnectId, float $price);

    /**
     * Make the OAuth url to create a standard connect account.
     *
     * @param int $id
     * @return mixed|string
     */
    public function createStandardUrl(int $id);

    /**
     * Make the OAuth url to create a express connect account.
     *
     * @param int $id
     * @return mixed|string
     */
    public function createExpressUrl(int $id);

    /**
     * Reverse a transfer made to a user.
     *
     * @param string $token
     * @return mixed
     */
    public function reversePayout(string $token);
}
