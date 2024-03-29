# Payment Methods

Manage a business&#039;s payment methods.

---

- [Show Payment Methods](#all-payment-methods)


- [Save Payment Method](#save-payment-method)


- [Update Default](#default-payment-method)


- [Remove Payment Method](#remove-payment-method)



<a name="all-payment-methods"></a>
## Show Payment Methods

Show all of a business&#039;s payment methods.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payment-methods`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show payment methods",
    "data": [
        {
            "id": "pm_1HUBTHD2YnIDoaEIlLFGrCE8",
            "object": "payment_method",
            "billing_details": {
                "address": {
                    "city": null,
                    "country": null,
                    "line1": null,
                    "line2": null,
                    "postal_code": null,
                    "state": null
                },
                "email": null,
                "name": null,
                "phone": null
            },
            "card": {
                "brand": "mastercard",
                "checks": {
                    "address_line1_check": null,
                    "address_postal_code_check": null,
                    "cvc_check": "pass"
                },
                "country": "US",
                "exp_month": 3,
                "exp_year": 2022,
                "fingerprint": "h18IlRcbcU3djRqA",
                "funding": "debit",
                "generated_from": null,
                "last4": "8210",
                "networks": {
                    "available": [
                        "mastercard"
                    ],
                    "preferred": null
                },
                "three_d_secure_usage": {
                    "supported": true
                },
                "wallet": null
            },
            "created": 1600781031,
            "customer": "cus_I4K7grXAClDEcl",
            "livemode": false,
            "metadata": [],
            "type": "card",
            "default": false
        },
        {
            "id": "pm_1HUBTFD2YnIDoaEITKKoima0",
            "object": "payment_method",
            "billing_details": {
                "address": {
                    "city": null,
                    "country": null,
                    "line1": null,
                    "line2": null,
                    "postal_code": null,
                    "state": null
                },
                "email": null,
                "name": null,
                "phone": null
            },
            "card": {
                "brand": "visa",
                "checks": {
                    "address_line1_check": null,
                    "address_postal_code_check": null,
                    "cvc_check": "pass"
                },
                "country": "US",
                "exp_month": 6,
                "exp_year": 2021,
                "fingerprint": "79RdvAqUWe4Fl0xo",
                "funding": "credit",
                "generated_from": null,
                "last4": "4242",
                "networks": {
                    "available": [
                        "visa"
                    ],
                    "preferred": null
                },
                "three_d_secure_usage": {
                    "supported": true
                },
                "wallet": null
            },
            "created": 1600781029,
            "customer": "cus_I4K7grXAClDEcl",
            "livemode": false,
            "metadata": [],
            "type": "card",
            "default": false
        },
        {
            "id": "pm_1HUBTFD2YnIDoaEITKKoima0",
            "object": "payment_method",
            "billing_details": {
                "address": {
                    "city": null,
                    "country": null,
                    "line1": null,
                    "line2": null,
                    "postal_code": null,
                    "state": null
                },
                "email": null,
                "name": null,
                "phone": null
            },
            "card": {
                "brand": "visa",
                "checks": {
                    "address_line1_check": null,
                    "address_postal_code_check": null,
                    "cvc_check": "pass"
                },
                "country": "US",
                "exp_month": 6,
                "exp_year": 2021,
                "fingerprint": "79RdvAqUWe4Fl0xo",
                "funding": "credit",
                "generated_from": null,
                "last4": "4242",
                "networks": {
                    "available": [
                        "visa"
                    ],
                    "preferred": null
                },
                "three_d_secure_usage": {
                    "supported": true
                },
                "wallet": null
            },
            "created": 1600781029,
            "customer": "cus_I4K7grXAClDEcl",
            "livemode": false,
            "metadata": [],
            "type": "card",
            "default": true
        }
    ]
}

```



<a name="save-payment-method"></a>
## Save Payment Method

Save a payment method for a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/payment-methods`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`payment_method_id`|`string`|`required`|`The id of the payment method object created by Stripe.`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Payment method has been saved.",
    "data": {
        "id": "pm_1HUBZYD2YnIDoaEIs8vrcDv7",
        "object": "payment_method",
        "billing_details": {
            "address": {
                "city": null,
                "country": null,
                "line1": null,
                "line2": null,
                "postal_code": null,
                "state": null
            },
            "email": null,
            "name": null,
            "phone": null
        },
        "card": {
            "brand": "discover",
            "checks": {
                "address_line1_check": null,
                "address_postal_code_check": null,
                "cvc_check": "pass"
            },
            "country": "US",
            "exp_month": 6,
            "exp_year": 2022,
            "fingerprint": "Rqby8zuDfpkHD2Yc",
            "funding": "credit",
            "generated_from": null,
            "last4": "1117",
            "networks": {
                "available": [
                    "discover"
                ],
                "preferred": null
            },
            "three_d_secure_usage": {
                "supported": false
            },
            "wallet": null
        },
        "created": 1600781420,
        "customer": "cus_I4K7grXAClDEcl",
        "livemode": false,
        "metadata": [],
        "type": "card"
    }
}

```



<a name="default-payment-method"></a>
## Update Default

Update a business&#039;s default payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/payment-method/{payment_method_id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your default payment method has been updated.",
    "data": null
}

```



<a name="remove-payment-method"></a>
## Remove Payment Method

Remove a business&#039;s payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/business/{unique_id}/payment-method/{payment_method_id}`|`true`|



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


