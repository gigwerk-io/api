# Register

These routes belong are responsible for registration processes.

---

- [Create User](#register-user)


- [Create business](#register-business)


- [Join business](#join-business)



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
            "first_name": "Chelsie",
            "last_name": "Ulises",
            "username": "JND1pEqwB2",
            "email": "JND1pEqwB2@mail.com",
            "phone": "+117349268830",
            "updated_at": "2020-09-22T13:30:08.000000Z",
            "created_at": "2020-09-22T13:30:08.000000Z",
            "id": 76,
            "isActive": false,
            "lastSeen": null,
            "profile": {
                "id": 76,
                "user_id": 76,
                "image": "https:\/\/s3.us-east-2.amazonaws.com\/favr-images\/user.png",
                "description": null,
                "created_at": "2020-09-22T13:30:08.000000Z",
                "updated_at": "2020-09-22T13:30:08.000000Z"
            }
        }
    }
}

```



<a name="register-business"></a>
## Create business

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
        "name": "Gaylord LLC",
        "subdomain_prefix": "prosacco",
        "owner_id": 1,
        "unique_id": "e09c2c2c-37c3-4cb9-aabf-c6f766001acf",
        "updated_at": "2020-09-22T13:30:08.000000Z",
        "created_at": "2020-09-22T13:30:08.000000Z",
        "id": 3,
        "profile": {
            "id": 3,
            "business_id": 3,
            "image": null,
            "cover": null,
            "short_description": null,
            "long_description": null,
            "primary_color": null,
            "secondary_color": null,
            "created_at": "2020-09-22T13:30:10.000000Z",
            "updated_at": "2020-09-22T13:30:10.000000Z"
        },
        "location": {
            "id": 3,
            "business_id": 3,
            "street_address": "832 Stiedemann Row",
            "city": "Rochester",
            "state": "MN",
            "zip": "55901",
            "lat": 44.0308259,
            "long": -92.4752535,
            "created_at": "2020-09-22T13:30:10.000000Z",
            "updated_at": "2020-09-22T13:30:10.000000Z"
        },
        "owner": {
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
            "lastSeen": null
        }
    }
}

```



<a name="join-business"></a>
## Join business

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


