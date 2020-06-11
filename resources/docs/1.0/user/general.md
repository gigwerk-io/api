# General



---

- [All Payments](#all-payments)


- [Single Payment](#single-payment)



<a name="all-payments"></a>
## All Payments

Show a list of all payments within a business app.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payments`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show all payments",
    "data": [
        {
            "id": 1,
            "marketplace_id": 4,
            "user_id": 1,
            "amount": 46,
            "stripe_token": "ch_1GrDBtD2YnIDoaEIcyxG6RpL",
            "refunded": false,
            "created_at": "2020-06-07T01:20:51.000000Z",
            "updated_at": "2020-06-07T01:20:51.000000Z"
        },
        {
            "id": 2,
            "marketplace_id": 5,
            "user_id": 1,
            "amount": 24,
            "stripe_token": "ch_1GrDBvD2YnIDoaEIKVvY3DKt",
            "refunded": false,
            "created_at": "2020-06-07T01:20:52.000000Z",
            "updated_at": "2020-06-07T01:20:52.000000Z"
        }
    ]
}

```



<a name="single-payment"></a>
## Single Payment

Show a single payment with the job and user.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payment/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show payment",
    "data": {
        "id": 1,
        "marketplace_id": 4,
        "user_id": 1,
        "amount": 46,
        "stripe_token": "ch_1GrDBtD2YnIDoaEIcyxG6RpL",
        "refunded": false,
        "created_at": "2020-06-07T01:20:51.000000Z",
        "updated_at": "2020-06-07T01:20:51.000000Z"
    }
}

```


