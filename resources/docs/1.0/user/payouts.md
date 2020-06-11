# Payouts

These routes belong are responsible for show user payouts.

---

- [All payouts](#all-payouts)


- [Single payout](#single-payout)



<a name="all-payouts"></a>
## All payouts

Show a list of all payouts within a business app.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payouts`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show all payouts",
    "data": [
        {
            "id": 1,
            "marketplace_id": 5,
            "user_id": 1,
            "amount": 22,
            "stripe_token": "tr_1GrDBwD2YnIDoaEI3xNREgHK",
            "reversed": false,
            "created_at": "2020-06-07T01:20:53.000000Z",
            "updated_at": "2020-06-07T01:20:53.000000Z"
        }
    ]
}

```



<a name="single-payout"></a>
## Single payout

Show a single payout with the job and user.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payout/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show payout",
    "data": {
        "id": 1,
        "marketplace_id": 5,
        "user_id": 1,
        "amount": 22,
        "stripe_token": "tr_1GrDBwD2YnIDoaEI3xNREgHK",
        "reversed": false,
        "created_at": "2020-06-07T01:20:53.000000Z",
        "updated_at": "2020-06-07T01:20:53.000000Z"
    }
}

```


