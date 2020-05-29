# Login

These routes belong are responsible for creating deleting and validating login/session tokens.

---

- [Default Login](#basic-login)


- [Validate Session](#validate)


- [End Session](#logout)


- [Business App Login](#business-login)


- [Validate Business Token](#business-validate)



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
            "first_name": "Laney",
            "last_name": "Cassandra",
            "username": "business_admin",
            "email": "kylee63@example.org",
            "phone": "203-655-5402",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-19T00:33:07.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-19T00:33:07.000000Z",
            "updated_at": "2020-05-19T00:33:07.000000Z",
            "isActive": false,
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                "description": "Et in aperiam omnis.",
                "created_at": "2020-05-19T00:33:07.000000Z",
                "updated_at": "2020-05-19T00:33:07.000000Z"
            }
        },
        "token": "6|h1WzpSZuKyKCM5SiGox1wHZJkASyn5rCXkcZC8qqLAY8DRaBIYKFGOhNeGhC95xehoDFicKYpJgZJeEX"
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
## Business App Login

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
            "first_name": "Laney",
            "last_name": "Cassandra",
            "username": "business_admin",
            "email": "kylee63@example.org",
            "phone": "203-655-5402",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-19T00:33:07.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-19T00:33:07.000000Z",
            "updated_at": "2020-05-19T00:33:07.000000Z",
            "isActive": false,
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                "description": "Et in aperiam omnis.",
                "created_at": "2020-05-19T00:33:07.000000Z",
                "updated_at": "2020-05-19T00:33:07.000000Z"
            }
        },
        "token": "6|h1WzpSZuKyKCM5SiGox1wHZJkASyn5rCXkcZC8qqLAY8DRaBIYKFGOhNeGhC95xehoDFicKYpJgZJeEX"
    }
}

```



<a name="business-validate"></a>
## Validate Business Token

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


