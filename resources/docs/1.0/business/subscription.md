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
        "name": "Pro Plan",
        "stripe_id": "sub_HYgekk7HkfZL2Y",
        "stripe_status": "trialing",
        "stripe_plan": "price_1GxadxD2YnIDoaEI8iOxwkI9",
        "quantity": 1,
        "trial_ends_at": "2020-07-14T02:32:43.000000Z",
        "ends_at": null,
        "created_at": "2020-06-30T02:32:44.000000Z",
        "updated_at": "2020-06-30T02:32:44.000000Z",
        "items": [
            {
                "id": 1,
                "subscription_id": 1,
                "stripe_id": "si_HYgebfkGPlnrSA",
                "stripe_plan": "price_1GxadxD2YnIDoaEI8iOxwkI9",
                "quantity": 1,
                "created_at": "2020-06-30T02:32:44.000000Z",
                "updated_at": "2020-06-30T02:32:44.000000Z"
            }
        ]
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


