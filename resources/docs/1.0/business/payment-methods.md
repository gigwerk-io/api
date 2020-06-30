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





<a name="default-payment-method"></a>
## Update Default

Update a business&#039;s default payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/payment-method/{payment_method_id}`|`true`|






<a name="remove-payment-method"></a>
## Remove Payment Method

Remove a business&#039;s payment method.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/business/{unique_id}/payment-method/{payment_method_id}`|`true`|





