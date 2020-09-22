# Stripe Connect

Stripe connect routes.

---

- [Save Stripe Account](#save-stripe)


- [Login to Stripe](#stripe-login)



<a name="save-stripe"></a>
## Save Stripe Account

Create Stripe express account so worker can get paid.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/bank`|`false`|

### Query Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`state`|`string`|`required`|`The token used to identify the user.`|
|`code`|`string`|`required`|`The temporary stripe token for OAuth confirmation.`|






<a name="stripe-login"></a>
## Login to Stripe

Get a URL to either create or login into a Stripe express account.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/stripe`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Get express OAuth URL",
    "data": {
        "url": "https:\/\/connect.stripe.com\/express\/qPWj7HBJZvtV"
    }
}

```


