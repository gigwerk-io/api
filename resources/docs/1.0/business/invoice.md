# Invoice

View past and future invoices for a business.

---

- [Past Invoices](#past-invoices)


- [Upcoming Invoice](#upcoming-invoice)



<a name="past-invoices"></a>
## Past Invoices

Show all past invoices for a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/invoices`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show business invoices",
    "data": [
        {
            "id": "in_1Gza0kD2YnIDoaEIPCRCVWkb",
            "object": "invoice",
            "account_country": "US",
            "account_name": "FAVR",
            "amount_due": 0,
            "amount_paid": 0,
            "amount_remaining": 0,
            "application_fee_amount": null,
            "attempt_count": 0,
            "attempted": true,
            "auto_advance": false,
            "billing_reason": "subscription_create",
            "charge": null,
            "collection_method": "charge_automatically",
            "created": 1593487194,
            "currency": "usd",
            "custom_fields": null,
            "customer": "cus_HYhP4YGkwN6QlR",
            "customer_address": null,
            "customer_email": null,
            "customer_name": "First Business Inc.",
            "customer_phone": null,
            "customer_shipping": null,
            "customer_tax_exempt": "none",
            "customer_tax_ids": [],
            "default_payment_method": null,
            "default_source": null,
            "default_tax_rates": [],
            "description": null,
            "discount": null,
            "due_date": null,
            "ending_balance": 0,
            "footer": null,
            "hosted_invoice_url": "https:\/\/pay.stripe.com\/invoice\/acct_1BMA1zD2YnIDoaEI\/invst_HYhPVnlNX75sxpY99T8b0wzsTzfCqEr",
            "invoice_pdf": "https:\/\/pay.stripe.com\/invoice\/acct_1BMA1zD2YnIDoaEI\/invst_HYhPVnlNX75sxpY99T8b0wzsTzfCqEr\/pdf",
            "lines": {
                "object": "list",
                "data": [
                    {
                        "id": "il_1Gza0kD2YnIDoaEIZSWk509W",
                        "object": "line_item",
                        "amount": 0,
                        "currency": "usd",
                        "description": "Trial period for Pro Plan",
                        "discountable": true,
                        "livemode": false,
                        "metadata": [],
                        "period": {
                            "end": 1594696794,
                            "start": 1593487194
                        },
                        "plan": {
                            "id": "price_1GxadxD2YnIDoaEI8iOxwkI9",
                            "object": "plan",
                            "active": true,
                            "aggregate_usage": null,
                            "amount": 7900,
                            "amount_decimal": "7900",
                            "billing_scheme": "per_unit",
                            "created": 1593012969,
                            "currency": "usd",
                            "interval": "month",
                            "interval_count": 1,
                            "livemode": false,
                            "metadata": [],
                            "nickname": null,
                            "product": "prod_HWdvZIpBaw22kK",
                            "tiers": null,
                            "tiers_mode": null,
                            "transform_usage": null,
                            "trial_period_days": null,
                            "usage_type": "licensed"
                        },
                        "price": {
                            "id": "price_1GxadxD2YnIDoaEI8iOxwkI9",
                            "object": "price",
                            "active": true,
                            "billing_scheme": "per_unit",
                            "created": 1593012969,
                            "currency": "usd",
                            "livemode": false,
                            "lookup_key": null,
                            "metadata": [],
                            "nickname": null,
                            "product": "prod_HWdvZIpBaw22kK",
                            "recurring": {
                                "aggregate_usage": null,
                                "interval": "month",
                                "interval_count": 1,
                                "trial_period_days": null,
                                "usage_type": "licensed"
                            },
                            "tiers_mode": null,
                            "transform_quantity": null,
                            "type": "recurring",
                            "unit_amount": 7900,
                            "unit_amount_decimal": "7900"
                        },
                        "proration": false,
                        "quantity": 1,
                        "subscription": "sub_HYhPd0KpT7N9Yv",
                        "subscription_item": "si_HYhPlqr4sE6dNa",
                        "tax_amounts": [],
                        "tax_rates": [],
                        "type": "subscription"
                    }
                ],
                "has_more": false,
                "total_count": 1,
                "url": "\/v1\/invoices\/in_1Gza0kD2YnIDoaEIPCRCVWkb\/lines"
            },
            "livemode": false,
            "metadata": [],
            "next_payment_attempt": null,
            "number": "F775278F-0001",
            "paid": true,
            "payment_intent": null,
            "period_end": 1593487194,
            "period_start": 1593487194,
            "post_payment_credit_notes_amount": 0,
            "pre_payment_credit_notes_amount": 0,
            "receipt_number": null,
            "starting_balance": 0,
            "statement_descriptor": null,
            "status": "paid",
            "status_transitions": {
                "finalized_at": 1593487194,
                "marked_uncollectible_at": null,
                "paid_at": 1593487194,
                "voided_at": null
            },
            "subscription": "sub_HYhPd0KpT7N9Yv",
            "subtotal": 0,
            "tax": null,
            "tax_percent": null,
            "total": 0,
            "total_tax_amounts": [],
            "transfer_data": null,
            "webhooks_delivered_at": 1593487196
        }
    ]
}

```



<a name="upcoming-invoice"></a>
## Upcoming Invoice

Show upcoming invoice for a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/invoice`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show upcoming invoice",
    "data": {
        "object": "invoice",
        "account_country": "US",
        "account_name": "FAVR",
        "amount_due": 7900,
        "amount_paid": 0,
        "amount_remaining": 7900,
        "application_fee_amount": null,
        "attempt_count": 0,
        "attempted": false,
        "billing_reason": "upcoming",
        "charge": null,
        "collection_method": "charge_automatically",
        "created": 1594696794,
        "currency": "usd",
        "custom_fields": null,
        "customer": "cus_HYhP4YGkwN6QlR",
        "customer_address": null,
        "customer_email": null,
        "customer_name": "First Business Inc.",
        "customer_phone": null,
        "customer_shipping": null,
        "customer_tax_exempt": "none",
        "customer_tax_ids": [],
        "default_payment_method": null,
        "default_source": null,
        "default_tax_rates": [],
        "description": null,
        "discount": null,
        "due_date": null,
        "ending_balance": 0,
        "footer": null,
        "lines": {
            "object": "list",
            "data": [
                {
                    "id": "il_tmp_ab6785e97d4dcf",
                    "object": "line_item",
                    "amount": 7900,
                    "currency": "usd",
                    "description": "1 \u00d7 Pro Plan (at $79.00 \/ month)",
                    "discountable": true,
                    "livemode": false,
                    "metadata": [],
                    "period": {
                        "end": 1597375194,
                        "start": 1594696794
                    },
                    "plan": {
                        "id": "price_1GxadxD2YnIDoaEI8iOxwkI9",
                        "object": "plan",
                        "active": true,
                        "aggregate_usage": null,
                        "amount": 7900,
                        "amount_decimal": "7900",
                        "billing_scheme": "per_unit",
                        "created": 1593012969,
                        "currency": "usd",
                        "interval": "month",
                        "interval_count": 1,
                        "livemode": false,
                        "metadata": [],
                        "nickname": null,
                        "product": "prod_HWdvZIpBaw22kK",
                        "tiers": null,
                        "tiers_mode": null,
                        "transform_usage": null,
                        "trial_period_days": null,
                        "usage_type": "licensed"
                    },
                    "price": {
                        "id": "price_1GxadxD2YnIDoaEI8iOxwkI9",
                        "object": "price",
                        "active": true,
                        "billing_scheme": "per_unit",
                        "created": 1593012969,
                        "currency": "usd",
                        "livemode": false,
                        "lookup_key": null,
                        "metadata": [],
                        "nickname": null,
                        "product": "prod_HWdvZIpBaw22kK",
                        "recurring": {
                            "aggregate_usage": null,
                            "interval": "month",
                            "interval_count": 1,
                            "trial_period_days": null,
                            "usage_type": "licensed"
                        },
                        "tiers_mode": null,
                        "transform_quantity": null,
                        "type": "recurring",
                        "unit_amount": 7900,
                        "unit_amount_decimal": "7900"
                    },
                    "proration": false,
                    "quantity": 1,
                    "subscription": "sub_HYhPd0KpT7N9Yv",
                    "subscription_item": "si_HYhPlqr4sE6dNa",
                    "tax_amounts": [],
                    "tax_rates": [],
                    "type": "subscription"
                }
            ],
            "has_more": false,
            "total_count": 1,
            "url": "\/v1\/invoices\/upcoming\/lines?customer=cus_HYhP4YGkwN6QlR"
        },
        "livemode": false,
        "metadata": [],
        "next_payment_attempt": 1594700394,
        "number": "F775278F-0002",
        "paid": false,
        "payment_intent": null,
        "period_end": 1594696794,
        "period_start": 1593487194,
        "post_payment_credit_notes_amount": 0,
        "pre_payment_credit_notes_amount": 0,
        "receipt_number": null,
        "starting_balance": 0,
        "statement_descriptor": null,
        "status": "draft",
        "status_transitions": {
            "finalized_at": null,
            "marked_uncollectible_at": null,
            "paid_at": null,
            "voided_at": null
        },
        "subscription": "sub_HYhPd0KpT7N9Yv",
        "subtotal": 7900,
        "tax": null,
        "tax_percent": null,
        "total": 7900,
        "total_tax_amounts": [],
        "transfer_data": null,
        "webhooks_delivered_at": null
    }
}

```


