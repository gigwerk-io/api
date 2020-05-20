# Register

These routes belong are responsible for registration processes.

---

- [Create User](#register-user)


- [Create Business](#register-business)


- [Join Business](#join-business)



<a name="register-user"></a>
## Create User

Create a new account with Gigwerk.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/register`|`false`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`first_name`|`string`|`requred`|`The first name of the user.`|
|`last_name`|`string`|`requred`|`The last name of the user.`|
|`username`|`string`|`requred`|`The username of the user.`|
|`email`|`string`|`requred`|`The email of the user.`|
|`phone`|`string`|`requred`|`The phone number of the user.`|
|`password`|`string`|`required`|`The password for the user.`|


> {success} Example Success Response
Code `201`

Content

```json
{
    "success": true,
    "message": "User has been successfully registered.",
    "data": {
        "user": {
            "first_name": "Ima",
            "last_name": "Casper",
            "username": "SbA1ZmSRie",
            "email": "SbA1ZmSRie@mail.com",
            "phone": "+115515942179",
            "updated_at": "2020-05-19T03:55:50.000000Z",
            "created_at": "2020-05-19T03:55:50.000000Z",
            "id": 10,
            "isActive": false,
            "profile": {
                "id": 10,
                "user_id": 10,
                "image": "https:\/\/s3.us-east-2.amazonaws.com\/favr-images\/user.png",
                "description": null,
                "created_at": "2020-05-19T03:55:50.000000Z",
                "updated_at": "2020-05-19T03:55:50.000000Z"
            }
        }
    }
}

```



<a name="register-business"></a>
## Create Business

Create a business account with Gigwerk.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business-register`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`name`|`string`|`required`|`The name of the business`|
|`subdomain_prefix`|`string`|`required`|`The subdomain for the business`|
|`street_address`|`string`|`required`|`The address of the job location`|
|`city`|`string`|`required`|`The city of the job location.`|
|`state`|`string`|`required`|`The state of the job location.`|
|`zip`|`string`|`required`|`The zip code of the job location.`|


> {success} Example Success Response
Code `201`

Content

```json
{
    "success": true,
    "message": "Your business has been created",
    "data": {
        "name": "Christiansen PLC",
        "subdomain_prefix": "feest",
        "owner_id": 1,
        "unique_id": "78716621-5da5-4e16-813c-10d44113542b",
        "updated_at": "2020-05-19T03:55:50.000000Z",
        "created_at": "2020-05-19T03:55:50.000000Z",
        "id": 11,
        "profile": {
            "id": 7,
            "business_id": 11,
            "image": null,
            "cover": null,
            "short_description": null,
            "long_description": null,
            "primary_color": null,
            "secondary_color": null,
            "created_at": "2020-05-19T03:55:51.000000Z",
            "updated_at": "2020-05-19T03:55:51.000000Z"
        },
        "location": {
            "id": 7,
            "business_id": 11,
            "street_address": "820 Schaden Locks Apt. 320",
            "city": "Rochester",
            "state": "MN",
            "zip": "55901",
            "lat": 44.0780552,
            "long": -92.5098914,
            "created_at": "2020-05-19T03:55:51.000000Z",
            "updated_at": "2020-05-19T03:55:51.000000Z"
        }
    }
}

```



<a name="join-business"></a>
## Join Business

Request to join a business marketplace as a worker.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/join`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your application has been sent",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "You are already a member of this business marketplace",
    "data": null
}

```


