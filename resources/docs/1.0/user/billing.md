# Billing

Manage users billing settings.

---

- [All Payment Methods](#all-methods)


- [Single Payment Method](#single-method)


- [Save Card](#save-card)


- [Make Default](#make-default)


- [Remove Payment Method](#delete-method)



<a name="all-methods"></a>
## All Payment Methods

Show a list of user payment methods
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/cards`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show payment methods",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "stripe_customer_id": "cus_FsQcawWaxlmfbs",
            "stripe_card_id": "card_1FMflHD2YnIDoaEIqLthZhO8",
            "card_type": "Visa",
            "card_last4": "4242",
            "exp_month": 12,
            "exp_year": 2023,
            "default": true,
            "created_at": "2020-06-07T01:20:39.000000Z",
            "updated_at": "2020-06-07T01:20:39.000000Z"
        }
    ]
}

```



<a name="single-method"></a>
## Single Payment Method

Show a single user payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/card/{id}`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show payment method",
    "data": {
        "id": 1,
        "user_id": 1,
        "stripe_customer_id": "cus_FsQcawWaxlmfbs",
        "stripe_card_id": "card_1FMflHD2YnIDoaEIqLthZhO8",
        "card_type": "Visa",
        "card_last4": "4242",
        "exp_month": 12,
        "exp_year": 2023,
        "default": true,
        "created_at": "2020-06-07T01:20:39.000000Z",
        "updated_at": "2020-06-07T01:20:39.000000Z"
    }
}

```



<a name="save-card"></a>
## Save Card

Save a customers payment details via Stripe
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/cards`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your card has been saved.",
    "data": null
}

```



<a name="make-default"></a>
## Make Default

Make a payment method the default.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/card/{id}`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Default payment method has been saved.",
    "data": null
}

```



<a name="delete-method"></a>
## Remove Payment Method

Remove a user payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/card/{id}`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "This payment method has been removed.",
    "data": null
}

```


