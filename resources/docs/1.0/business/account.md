# Account

These routes belong are responsible for managing business accounts.

---

- [Update Profile](#update-profile)


- [Update Location](#update-location)


- [Stripe Login](#stripe-login)



<a name="update-profile"></a>
## Update Profile

This updates a businesses profile.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/profile`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`name`|`string`|`optional`|`Update the name of the business`|
|`image`|`base64`|`optional`|`Update the profile image of the business.`|
|`cover`|`base64`|`optional`|`Update the cover image of the business.`|
|`short_description`|`string`|`optional`|`Update the headline of the business.`|
|`long_description`|`string`|`optional`|`Update the description of the business.`|
|`primary_color`|`string`|`optional`|`Update the primary color of your business app`|
|`secondary_color`|`string`|`optional`|`Update the secondary color of your business app`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your business has been updated",
    "data": null
}

```



<a name="update-location"></a>
## Update Location

Update the location of the business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/location`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`street_address`|`string`|`optional`|`The address of the job location`|
|`city`|`string`|`optional`|`The city of the job location.`|
|`state`|`string`|`optional`|`The state of the job location.`|
|`zip`|`string`|`optional`|`The zip code of the job location.`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your business location has been updated",
    "data": null
}

```



<a name="stripe-login"></a>
## Stripe Login

Login or create Stripe Connect account for a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/stripe`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Stripe OAuth link created",
    "data": {
        "url": "https:\/\/connect.stripe.com\/express\/tLP0XCtao0e7"
    }
}

```


