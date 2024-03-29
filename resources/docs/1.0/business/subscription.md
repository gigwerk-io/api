# Subscription

Manage a business&#039;s subscription with Gigwerk.

---

- [Show Subscription](#show-subscription)


- [Change Subscription](#change-subscription)


- [Cancel Subscription](#cancel-subscription)



<a name="show-subscription"></a>
## Show Subscription

Show the subscription plan for a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/subscription`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show subscription",
    "data": {
        "id": 1,
        "business_id": 1,
        "name": "Pro",
        "stripe_id": "sub_I4K7YD8WvbbayU",
        "stripe_status": "active",
        "stripe_plan": "price_1HPVVFD2YnIDoaEI6HF3KWGC",
        "quantity": 1,
        "trial_ends_at": null,
        "ends_at": null,
        "created_at": "2020-09-22T13:23:54.000000Z",
        "updated_at": "2020-09-22T13:23:54.000000Z",
        "stripeSubscription": {
            "id": "sub_I4K7YD8WvbbayU",
            "object": "subscription",
            "application_fee_percent": null,
            "billing_cycle_anchor": 1600781032,
            "billing_thresholds": null,
            "cancel_at": null,
            "cancel_at_period_end": false,
            "canceled_at": null,
            "collection_method": "charge_automatically",
            "created": 1600781032,
            "current_period_end": 1603373032,
            "current_period_start": 1600781032,
            "customer": "cus_I4K7grXAClDEcl",
            "days_until_due": null,
            "default_payment_method": null,
            "default_source": null,
            "default_tax_rates": [],
            "discount": null,
            "ended_at": null,
            "items": {
                "object": "list",
                "data": [
                    {
                        "id": "si_I4K7DC0p9pW9kx",
                        "object": "subscription_item",
                        "billing_thresholds": null,
                        "created": 1600781033,
                        "metadata": [],
                        "plan": {
                            "id": "price_1HPVVFD2YnIDoaEI6HF3KWGC",
                            "object": "plan",
                            "active": true,
                            "aggregate_usage": null,
                            "amount": 9900,
                            "amount_decimal": "9900",
                            "billing_scheme": "per_unit",
                            "created": 1599666393,
                            "currency": "usd",
                            "interval": "month",
                            "interval_count": 1,
                            "livemode": false,
                            "metadata": [],
                            "nickname": null,
                            "product": "prod_HzUUeM2CdxIIwD",
                            "tiers": null,
                            "tiers_mode": null,
                            "transform_usage": null,
                            "trial_period_days": 14,
                            "usage_type": "licensed"
                        },
                        "price": {
                            "id": "price_1HPVVFD2YnIDoaEI6HF3KWGC",
                            "object": "price",
                            "active": true,
                            "billing_scheme": "per_unit",
                            "created": 1599666393,
                            "currency": "usd",
                            "livemode": false,
                            "lookup_key": null,
                            "metadata": [],
                            "nickname": null,
                            "product": "prod_HzUUeM2CdxIIwD",
                            "recurring": {
                                "aggregate_usage": null,
                                "interval": "month",
                                "interval_count": 1,
                                "trial_period_days": 14,
                                "usage_type": "licensed"
                            },
                            "tiers_mode": null,
                            "transform_quantity": null,
                            "type": "recurring",
                            "unit_amount": 9900,
                            "unit_amount_decimal": "9900"
                        },
                        "quantity": 1,
                        "subscription": "sub_I4K7YD8WvbbayU",
                        "tax_rates": []
                    }
                ],
                "has_more": false,
                "total_count": 1,
                "url": "\/v1\/subscription_items?subscription=sub_I4K7YD8WvbbayU"
            },
            "latest_invoice": "in_1HUBTID2YnIDoaEIHY9crG88",
            "livemode": false,
            "metadata": [],
            "next_pending_invoice_item_invoice": null,
            "pause_collection": null,
            "pending_invoice_item_interval": null,
            "pending_setup_intent": null,
            "pending_update": null,
            "plan": {
                "id": "price_1HPVVFD2YnIDoaEI6HF3KWGC",
                "object": "plan",
                "active": true,
                "aggregate_usage": null,
                "amount": 9900,
                "amount_decimal": "9900",
                "billing_scheme": "per_unit",
                "created": 1599666393,
                "currency": "usd",
                "interval": "month",
                "interval_count": 1,
                "livemode": false,
                "metadata": [],
                "nickname": null,
                "product": "prod_HzUUeM2CdxIIwD",
                "tiers": null,
                "tiers_mode": null,
                "transform_usage": null,
                "trial_period_days": 14,
                "usage_type": "licensed"
            },
            "quantity": 1,
            "schedule": null,
            "start_date": 1600781032,
            "status": "active",
            "tax_percent": null,
            "transfer_data": null,
            "trial_end": null,
            "trial_start": null
        },
        "items": [
            {
                "id": 1,
                "subscription_id": 1,
                "stripe_id": "si_I4K7DC0p9pW9kx",
                "stripe_plan": "price_1HPVVFD2YnIDoaEI6HF3KWGC",
                "quantity": 1,
                "created_at": "2020-09-22T13:23:54.000000Z",
                "updated_at": "2020-09-22T13:23:54.000000Z"
            }
        ],
        "owner": {
            "id": 1,
            "owner_id": 1,
            "unique_id": "ea11187b-fba5-31c8-87b4-84928c0334d6",
            "name": "Weyland-Yutani Corporation",
            "is_accepting_applications": true,
            "is_approved": false,
            "subdomain_prefix": "weyland-yutani",
            "stripe_connect_id": "acct_1F7RiLBKeAbZ6utM",
            "created_at": "2020-09-22T13:23:49.000000Z",
            "updated_at": "2020-09-22T13:23:51.000000Z",
            "deleted_at": null,
            "stripe_id": "cus_I4K7grXAClDEcl",
            "card_brand": "visa",
            "card_last_four": "4242",
            "trial_ends_at": null
        }
    }
}

```



<a name="change-subscription"></a>
## Change Subscription

Change a business subscription.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/subscription`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`subscription_id`|`string`|`required`|`The subscription plan id provided via Stripe.`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You are now subscribed to the Basic Plan.",
    "data": null
}

```



<a name="cancel-subscription"></a>
## Cancel Subscription

Cancel a business subscription.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/business/{unique_id}/subscription`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You have cancelled your subscription.",
    "data": null
}

```


