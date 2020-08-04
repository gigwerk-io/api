# Account

These routes belong are responsible for managing business accounts.

---

- [Show Account](#show-account)


- [Update Profile](#update-profile)


- [Update Location](#update-location)


- [Stripe Login](#stripe-login)



<a name="show-account"></a>
## Show Account

Show the details of a business account.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/account`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show business",
    "data": {
        "id": 1,
        "owner_id": 1,
        "unique_id": "63f084c7-a899-3f6b-bb7d-e8b054e13b66",
        "name": "First business Inc.",
        "subdomain_prefix": "demo",
        "stripe_connect_id": "acct_1F7RiLBKeAbZ6utM",
        "created_at": "2020-06-07T01:20:39.000000Z",
        "updated_at": "2020-06-07T01:20:39.000000Z",
        "deleted_at": null,
        "location": {
            "id": 1,
            "business_id": 1,
            "street_address": "2904 Janis Heights",
            "city": "Rochester",
            "state": "MN",
            "zip": "55901",
            "lat": 44.0446131,
            "long": -92.4841607,
            "created_at": "2020-06-07T01:20:39.000000Z",
            "updated_at": "2020-06-07T01:20:39.000000Z"
        },
        "profile": {
            "id": 1,
            "business_id": 1,
            "image": "http:\/\/507outdoormanagement.com\/wp-content\/uploads\/2019\/10\/foliage-2942282_1920-1920x730.jpg",
            "cover": "http:\/\/507outdoormanagement.com\/wp-content\/uploads\/2019\/10\/foliage-2942282_1920-1920x730.jpg",
            "short_description": "Voluptas aut iusto nesciunt enim quia dignissimos aliquid.",
            "long_description": "Ea odio nemo cupiditate ab et. Consequatur eius placeat laudantium laborum eos explicabo. Reiciendis molestias dolores aut ipsa. Molestiae explicabo libero est sunt quae ratione nihil.",
            "primary_color": "#c9e64a",
            "secondary_color": "#00dd11",
            "created_at": "2020-06-07T01:20:39.000000Z",
            "updated_at": "2020-06-07T01:20:39.000000Z"
        }
    }
}

```



<a name="update-profile"></a>
## Update Profile

This updates a businesses profile.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/account`|`true`|


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
|`is_accepting_applications`|`boolean`|`optional`|`Update if your business is accepting applications or not`|


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


