<?php

namespace App\Http\Controllers\User;

use App\Contracts\Stripe\Billing;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use Stripe\Exception\ApiErrorException;

/**
 * @Group(name="Billing", description="Manage users billing settings.")
 */
class BillingController extends Controller
{
    /**
     * @var Billing
     */
    private $billing;

    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * @Meta(name="All Payment Methods", description="Show a list of user payment methods", href="all-methods")
     * @ResponseExample(status=200, example="responses/user/billing/all.payment.methods-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $paymentMethods = $user->paymentMethods()->get();

        return ResponseFactory::success('Show payment methods', $paymentMethods);
    }

    /**
     * @Meta(name="Single Payment Method", href="single-method", description="Show a single user payment method.")
     * @ResponseExample(status=200, example="responses/user/billing/show.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $paymentMethod = $user->paymentMethods()->where('id', '=', $request->id)->first();

        if (is_null($paymentMethod)) {
            return ResponseFactory::error('This payment method does not exist.', null, 404);
        }

        return ResponseFactory::success('Show payment method', $paymentMethod);
    }

    /**
     * @Meta(name="Save Card", href="save-card", description="Save a customers payment details via Stripe")
     * @ResponseExample(status=200, example="responses/user/billing/store.payment.method-201.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'token' => ['string']
        ]);

        /** @var User $user */
        $user = $request->user();

        try {
            $stripeCustomer = $this->billing->createCustomer($user, $request->token);
        } catch (ApiErrorException $e) {
            return ResponseFactory::error($e->getMessage());
        }

        $isDefault = !($user->paymentMethods()->count() > 0);

        $user->paymentMethods()->create([
            'stripe_customer_id' =>  $stripeCustomer[0]->id,
            'stripe_card_id' => $stripeCustomer[1]->card->id,
            'card_type' => $stripeCustomer[1]->card->brand,
            'card_last4' => $stripeCustomer[1]->card->last4,
            'exp_month' => $stripeCustomer[1]->card->exp_month,
            'exp_year' => $stripeCustomer[1]->card->exp_year,
            'default' => $isDefault
        ]);

        return  ResponseFactory::success(
            'Your card has been saved.',
            null,
            201
        );
    }

    /**
     * @Meta(name="Make Default", href="make-default", description="Make a payment method the default.")
     * @ResponseExample(status=200, example="responses/user/billing/update.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $paymentMethod = $user->paymentMethods()->where('id', '=', $request->id)->first();

        if (is_null($paymentMethod)) {
            return ResponseFactory::error('This payment method does not exist.', null, 404);
        }

        $user->paymentMethods()->update(['default' => false]);

        $paymentMethod->update(['default' => true]);

        return  ResponseFactory::success('Default payment method has been saved.');
    }

    /**
     * @Meta(name="Remove Payment Method", href="delete-method", description="Remove a user payment method.")
     * @ResponseExample(status=200, example="responses/user/billing/delete.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $paymentMethod = $user->paymentMethods()->where('id', '=', $request->id)->first();

        if (is_null($paymentMethod)) {
            return ResponseFactory::error('This payment method does not exist.', null, 404);
        }

        if (!($user->paymentMethods()->count() > 1)) {
            return ResponseFactory::error('You must have more than one payment method!');
        }

        return ResponseFactory::success('This payment method has been removed.');
    }
}
