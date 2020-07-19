<?php

namespace App\Http\Controllers\Business;

use App\Enum\Billing\Plan;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Cashier\Subscription;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Subscription", description="Manage a business's subscription with Gigwerk.")
 */
class SubscriptionController extends Controller
{
    /**
     * @Meta(name="Show Subscription", description="Show the subscription plan for a business.", href="show-subscription")
     * @ResponseExample(status=200, example="responses/business/subscription/show.subscription.plan-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $subscription = $business->subscriptions()->first();

        return ResponseFactory::success('Show subscription', $subscription);
    }

    /**
     * @Meta(name="Change Subscription", description="Change a business subscription.", href="change-subscription")
     * @BodyParam(name="subscription_id", type="string", status="required", description="The subscription plan id provided via Stripe.")
     * @ResponseExample(status=200, example="responses/business/subscription/update.subscription.plan-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Laravel\Cashier\Exceptions\SubscriptionUpdateFailure
     */
    public function update(Request $request)
    {
        $plans = Plan::toCollection();
        $planIds = $plans->map(function ($item){
            return $item['id'];
        });
        $this->validate($request, ['subscription_id' =>[ Rule::in($planIds), 'required']]);
        /** @var Business $business */
        $business = $request->get('business');

        /** @var Subscription $currentSubscription */
        $currentSubscription = $business->subscriptions()->first();

        $business->subscription($currentSubscription->name)->skipTrial()->swap($request->subscription_id);
        $newSubscription = $plans->where('id', '=', $request->subscription_id)->first();
        $currentSubscription->update(['name' =>  $newSubscription['name']]);

        return ResponseFactory::success(sprintf('You are now subscribed to the %s.', $newSubscription['name']));
    }

    /**
     * @Meta(name="Cancel Subscription", description="Cancel a business subscription.", href="cancel-subscription")
     * @ResponseExample(status=200, example="responses/business/subscription/cancel.subscription.plan-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function delete(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        /** @var Subscription $currentSubscription */
        $currentSubscription = $business->subscriptions()->first();

        $business->subscription($currentSubscription->name)->cancel();

        return ResponseFactory::success('You have cancelled your subscription.');
    }
}
