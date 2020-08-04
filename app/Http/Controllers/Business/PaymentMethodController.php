<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Laravel\Cashier\PaymentMethod;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use Stripe\Exception\InvalidRequestException;

/**
 * @Group(name="Payment Methods", description="Manage a business's payment methods.")
 */
class PaymentMethodController extends Controller
{
    /**
     * @Meta(name="Show Payment Methods", description="Show all of a business's payment methods.", href="all-payment-methods")
     * @ResponseExample(status=200, example="responses/business/payment-method/show.all.payment.methods-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $paymentMethods = $business->paymentMethods()->map(function (PaymentMethod $paymentMethod) {
            return $paymentMethod->asStripePaymentMethod();
        });

        return ResponseFactory::success('Show payment methods', $paymentMethods);
    }

    /**
     * @Meta(name="Save Payment Method", description="Save a payment method for a business.", href="save-payment-method")
     * @BodyParam(name="payment_method_id", status="required", type="string", description="The id of the payment method object created by Stripe.")
     * @ResponseExample(status=200, example="responses/business/payment-method/save.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, ['payment_method_id' => ['required', 'string']]);
        /** @var Business $business */
        $business = $request->get('business');

        try {
            $paymentMethod = $business->updateDefaultPaymentMethod($request->payment_method_id);
        }catch (InvalidRequestException $exception) {
            return ResponseFactory::error($exception->getMessage());
        }

        $business->updateDefaultPaymentMethodFromStripe();

        return ResponseFactory::success('Payment method has been saved.', $paymentMethod->asStripePaymentMethod());
    }

    /**
     * @Meta(name="Update Default", description="Update a business's default payment method.", href="default-payment-method")
     * @ResponseExample(status=200, example="responses/business/payment-method/update.default.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        try {
            $business->updateDefaultPaymentMethod($request->payment_method_id);
        }catch (InvalidRequestException $exception) {
            return ResponseFactory::error($exception->getMessage());
        }



        return ResponseFactory::success('Your default payment method has been updated.');
    }

    /**
     * @Meta(name="Remove Payment Method", description="Remove a business's payment method.", href="remove-payment-method")
     * @ResponseExample(status=200, example="responses/business/payment-method/remove.payment.method-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        try {
            $paymentMethod = $business->findPaymentMethod($request->payment_method_id);
        }catch (InvalidRequestException $exception) {
            return ResponseFactory::error($exception->getMessage());
        }

        $paymentMethod->delete();

        return ResponseFactory::success('This payment method has been removed.');
    }
}
