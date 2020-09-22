# Login

These routes belong are responsible for creating deleting and validating login/session tokens.

---

- [Default Login](#basic-login)


- [Validate Session](#validate)


- [End Session](#logout)


- [business App Login](#business-login)


- [Validate business Token](#business-validate)



<a name="basic-login"></a>
## Default Login

Login to a user account for the website or dashboard.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/login`|`false`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`username`|`string`|`required`|`The username or email of the user`|
|`password`|`string`|`required`|`The password for the user`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "User has logged in",
    "data": {
        "user": {
            "id": 1,
            "first_name": "Peter",
            "last_name": "Weyland",
            "username": "admin_one",
            "email": "admin_one@mail.com",
            "phone": "(460) 419-8167",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:49.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:49.000000Z",
            "updated_at": "2020-09-22T13:23:49.000000Z",
            "isActive": false,
            "lastSeen": null,
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/gigwerk-disk.s3.amazonaws.com\/seed\/peter-weyland.png",
                "description": "Founder and owner of the Weyland Corporation",
                "created_at": "2020-09-22T13:23:49.000000Z",
                "updated_at": "2020-09-22T13:23:49.000000Z"
            },
            "businesses": [
                {
                    "id": 1,
                    "owner_id": 1,
                    "unique_id": "ea11187b-fba5-31c8-87b4-84928c0334d6",
                    "name": "Weyland-Yutani Corporation",
                    "is_accepting_applications": true,
                    "is_approved": false,
                    "subdomain_prefix": "weyland-yutani",
                    "stripe_connect_id": "acct_1F7RiLBKeAbZ6utM",
                    "created_at": "2020-09-22T13:23:49.000000Z",
                    "updated_at": "2020-09-22T13:23:51.000000Z",
                    "deleted_at": null,
                    "stripe_id": "cus_I4K7grXAClDEcl",
                    "card_brand": "visa",
                    "card_last_four": "4242",
                    "trial_ends_at": null,
                    "pivot": {
                        "user_id": 1,
                        "business_id": 1,
                        "role_id": 3,
                        "apn_token": null,
                        "fcm_token": null,
                        "email_notifications": true,
                        "sms_notifications": true,
                        "push_notifications": true
                    },
                    "profile": {
                        "id": 1,
                        "business_id": 1,
                        "image": "https:\/\/gigwerk-disk.s3.amazonaws.com\/seed\/weyland-yutani.png",
                        "cover": "https:\/\/gigwerk-disk.s3.amazonaws.com\/roch.jpg",
                        "short_description": "Building better worlds",
                        "long_description": "Primarily a technology supplier, manufacturing synthetics, spaceships and computers for a wide range of industrial and commercial clients",
                        "primary_color": "#a04c5a",
                        "secondary_color": "#002200",
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z"
                    }
                }
            ]
        },
        "token": "1|STipJh9ZJCRoXhKEKAh4481y3pIw5XqVVOIr0zH4CLxjtNxHVMla8zX77V8LFXP44RCrDN5Uk8FP6wex"
    }
}

```



<a name="validate"></a>
## Validate Session

Check if a users session token is still valid.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/validate`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Token is valid.",
    "data": {
        "validToken": true
    }
}

```



<a name="logout"></a>
## End Session

Destroy a user session.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/logout`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "User has been logged out.",
    "data": null
}

```



<a name="business-login"></a>
## business App Login

Login to a businesses marketplace app.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/login`|`false`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`username`|`string`|`required`|`The username or email of the user`|
|`password`|`string`|`required`|`The password for the user`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "User has logged in",
    "data": {
        "user": {
            "id": 1,
            "first_name": "Peter",
            "last_name": "Weyland",
            "username": "admin_one",
            "email": "admin_one@mail.com",
            "phone": "(460) 419-8167",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:49.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:49.000000Z",
            "updated_at": "2020-09-22T13:23:49.000000Z",
            "role": "Customer",
            "business": {
                "id": 1,
                "owner_id": 1,
                "unique_id": "ea11187b-fba5-31c8-87b4-84928c0334d6",
                "name": "Weyland-Yutani Corporation",
                "is_accepting_applications": true,
                "is_approved": false,
                "subdomain_prefix": "weyland-yutani",
                "stripe_connect_id": "acct_1F7RiLBKeAbZ6utM",
                "created_at": "2020-09-22T13:23:49.000000Z",
                "updated_at": "2020-09-22T13:23:51.000000Z",
                "deleted_at": null,
                "stripe_id": "cus_I4K7grXAClDEcl",
                "card_brand": "visa",
                "card_last_four": "4242",
                "trial_ends_at": null
            },
            "isActive": false,
            "lastSeen": null,
            "pivot": {
                "business_id": 1,
                "user_id": 1,
                "role_id": 3,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true,
                "role": {
                    "id": 3,
                    "name": "Customer"
                }
            },
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/gigwerk-disk.s3.amazonaws.com\/seed\/peter-weyland.png",
                "description": "Founder and owner of the Weyland Corporation",
                "created_at": "2020-09-22T13:23:49.000000Z",
                "updated_at": "2020-09-22T13:23:49.000000Z"
            }
        },
        "token": "2|z8jJXNZJgqwyka1D2dzvROTHVttVa07MmQM0lBoEaE0yS8WZyS8AabBEGGIAr10Cm7XiSuL0ss9LNpOp"
    }
}

```



<a name="business-validate"></a>
## Validate business Token

Check if a users token has access to a specific business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/validate`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You have access to this business.",
    "data": {
        "validToken": true
    }
}

```


