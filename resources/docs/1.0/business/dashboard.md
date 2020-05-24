# Dashboard

This allows you to view statistics and performance of their marketplaces

---

- [User Stats](#user-stats)


- [Traffic Stats](#traffic-stats)


- [Time Worked](#time-worked)


- [Jobs Graph](#jobs-graph)


- [Payouts Graph](#payouts-graph)


- [Leaderboard](#leaderboard)



<a name="user-stats"></a>
## User Stats

Get user statistics like total count and growth.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/user-stats`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generating user stats",
    "data": {
        "total": 29,
        "growth": 2800
    }
}

```



<a name="traffic-stats"></a>
## Traffic Stats

Get the your business app usage statistics.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/traffic-stats`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generating traffic stats",
    "data": {
        "total": 0,
        "growth": 0
    }
}

```



<a name="time-worked"></a>
## Time Worked

Show the total amount of time worked in minutes.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/time-worked`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generating total time worked in minutes",
    "data": {
        "minutes": 1716.3666666666666
    }
}

```



<a name="jobs-graph"></a>
## Jobs Graph

Get the jobs over time via a graph.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/jobs-graph`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generating jobs graph",
    "data": {
        "labels": [
            "Nov",
            "Dec",
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May"
        ],
        "datasets": [
            {
                "label": "Jobs",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    5
                ]
            }
        ]
    }
}

```



<a name="payouts-graph"></a>
## Payouts Graph

Get the payouts over time via a graph.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/payouts-graph`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generating sales graph",
    "data": {
        "labels": [
            "Nov",
            "Dec",
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May"
        ],
        "datasets": [
            {
                "label": "Payouts",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    41
                ]
            }
        ]
    }
}

```



<a name="leaderboard"></a>
## Leaderboard

Get all users of a business in order of performance.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/leaderboard`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Showing the top workers",
    "data": [
        {
            "id": 1,
            "first_name": "Fredrick",
            "last_name": "Frida",
            "username": "admin_one",
            "email": "kamron.herzog@example.com",
            "phone": "1-886-945-1054",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:00.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:00.000000Z",
            "updated_at": "2020-05-22T00:32:00.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 28,
            "pivot": {
                "business_id": 1,
                "user_id": 1,
                "role_id": 1
            },
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/i.picsum.photos\/id\/58\/600\/600.jpg",
                "description": "Labore quod aperiam aut sapiente autem quo quas.",
                "created_at": "2020-05-22T00:32:00.000000Z",
                "updated_at": "2020-05-22T00:32:00.000000Z"
            }
        },
        {
            "id": 21,
            "first_name": "Marlee",
            "last_name": "Reanna",
            "username": "mrutherford62",
            "email": "jzemlak@example.net",
            "phone": "1-230-758-7078",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 21,
                "role_id": 1
            },
            "profile": {
                "id": 21,
                "user_id": 21,
                "image": "https:\/\/i.picsum.photos\/id\/558\/600\/600.jpg",
                "description": "Eveniet sed dicta sint asperiores velit dolorum.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 33,
            "first_name": "Kyla",
            "last_name": "Alyson",
            "username": "derek.damore64",
            "email": "brooke.bauch@example.org",
            "phone": "1-776-732-2521",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 33,
                "role_id": 2
            },
            "profile": {
                "id": 33,
                "user_id": 33,
                "image": "https:\/\/i.picsum.photos\/id\/650\/600\/600.jpg",
                "description": "Quae quod enim similique cupiditate aliquam esse placeat.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 32,
            "first_name": "Desiree",
            "last_name": "Amy",
            "username": "hgoodwin24",
            "email": "ukoch@example.org",
            "phone": "586.306.7302",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 32,
                "role_id": 2
            },
            "profile": {
                "id": 32,
                "user_id": 32,
                "image": "https:\/\/i.picsum.photos\/id\/650\/600\/600.jpg",
                "description": "Dolorem nostrum culpa accusamus.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 31,
            "first_name": "Shemar",
            "last_name": "Brooks",
            "username": "rafael.mueller39",
            "email": "groob@example.org",
            "phone": "758-930-4864 x1322",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 31,
                "role_id": 2
            },
            "profile": {
                "id": 31,
                "user_id": 31,
                "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                "description": "Nesciunt qui molestias quia nihil nemo.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 30,
            "first_name": "Elroy",
            "last_name": "Forrest",
            "username": "myrtle.koelpin79",
            "email": "zharvey@example.com",
            "phone": "586.478.5724",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 30,
                "role_id": 2
            },
            "profile": {
                "id": 30,
                "user_id": 30,
                "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                "description": "Nobis ullam aut in dolore eum laudantium.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 29,
            "first_name": "Ezequiel",
            "last_name": "Miguel",
            "username": "alysha.cruickshank81",
            "email": "tyrique.ankunding@example.com",
            "phone": "(426) 248-1729 x304",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 29,
                "role_id": 2
            },
            "profile": {
                "id": 29,
                "user_id": 29,
                "image": "https:\/\/i.picsum.photos\/id\/1019\/600\/600.jpg",
                "description": "Quod dolorum consequatur eos fuga molestiae neque.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 28,
            "first_name": "Rashad",
            "last_name": "Lilian",
            "username": "qledner60",
            "email": "lelia42@example.net",
            "phone": "1-449-410-9648 x57213",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 28,
                "role_id": 2
            },
            "profile": {
                "id": 28,
                "user_id": 28,
                "image": "https:\/\/i.picsum.photos\/id\/521\/600\/600.jpg",
                "description": "Eius nemo qui non illum repudiandae architecto.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 27,
            "first_name": "Maribel",
            "last_name": "Margie",
            "username": "schumm.leonie77",
            "email": "henriette86@example.org",
            "phone": "+1-725-614-3898",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 27,
                "role_id": 2
            },
            "profile": {
                "id": 27,
                "user_id": 27,
                "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                "description": "Consequuntur molestiae aliquam dolore qui.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        },
        {
            "id": 26,
            "first_name": "Victor",
            "last_name": "Dixie",
            "username": "jovanny.yost23",
            "email": "owisozk@example.net",
            "phone": "(339) 417-3459",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 26,
                "role_id": 2
            },
            "profile": {
                "id": 26,
                "user_id": 26,
                "image": "https:\/\/i.picsum.photos\/id\/835\/600\/600.jpg",
                "description": "Sed cumque sapiente itaque quas.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        }
    ]
}

```


