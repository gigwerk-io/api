# Payments

These routes belong are responsible for show user payments.

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
            "amount": 38,
            "stripe_token": "ch_1HUBTRD2YnIDoaEIceTDhbHW",
            "refunded": false,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z"
        },
        {
            "id": 2,
            "marketplace_id": 5,
            "user_id": 1,
            "amount": 19,
            "stripe_token": "ch_1HUBTSD2YnIDoaEIvnfVDb95",
            "refunded": false,
            "created_at": "2020-09-22T13:24:02.000000Z",
            "updated_at": "2020-09-22T13:24:02.000000Z"
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
        "amount": 38,
        "stripe_token": "ch_1HUBTRD2YnIDoaEIceTDhbHW",
        "refunded": false,
        "created_at": "2020-09-22T13:24:01.000000Z",
        "updated_at": "2020-09-22T13:24:01.000000Z"
    }
}

```


