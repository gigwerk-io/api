# Dashboard

This allows you to view statistics and performance of their marketplaces

---

- [Stats](#stats)


- [Graphs](#graphs)


- [Leaderboard](#leaderboard)



<a name="stats"></a>
## Stats

Get the statistics to present on the business dashboard.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/stats`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show dashboard stats",
    "data": {
        "applicants": 9,
        "jobs": 5,
        "payments": 57,
        "users": 29
    }
}

```



<a name="graphs"></a>
## Graphs

Get the graph data to present on the business dashboard.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/graphs`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show graph data",
    "data": {
        "jobs": {
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
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
        },
        "payments": {
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "datasets": [
                {
                    "label": "Payments",
                    "data": [
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        57
                    ]
                }
            ]
        }
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
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 18,
            "pivot": {
                "business_id": 1,
                "user_id": 1,
                "role_id": 3,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
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
        {
            "id": 21,
            "first_name": "Rashawn",
            "last_name": "Carson",
            "username": "ucorwin91",
            "email": "evangeline.vandervort@example.net",
            "phone": "+1-534-437-4879",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 21,
                "role_id": 1,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 21,
                "user_id": 21,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/94.jpg",
                "description": "Dolorem nesciunt mollitia repellat sed nobis quis et enim.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 33,
            "first_name": "Bradley",
            "last_name": "Buster",
            "username": "garret7984",
            "email": "lind.shirley@example.org",
            "phone": "+1-602-431-1277",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 33,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 33,
                "user_id": 33,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/95.jpg",
                "description": "Qui doloribus distinctio tempore et ab ad illo.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 32,
            "first_name": "Julianne",
            "last_name": "Immanuel",
            "username": "eldred.jast25",
            "email": "uspinka@example.org",
            "phone": "970.280.6369",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 32,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 32,
                "user_id": 32,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/97.jpg",
                "description": "Dolorem odio eius voluptates cupiditate quia.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 31,
            "first_name": "Christiana",
            "last_name": "Raul",
            "username": "ustanton48",
            "email": "alessandro.sauer@example.org",
            "phone": "+1.412.818.7891",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 31,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 31,
                "user_id": 31,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/98.jpg",
                "description": "Hic sit aut harum.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 30,
            "first_name": "Luigi",
            "last_name": "Ivy",
            "username": "jettie9787",
            "email": "phoebe15@example.org",
            "phone": "830.902.3027 x8518",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 30,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 30,
                "user_id": 30,
                "image": "https:\/\/randomuser.me\/api\/portraits\/men\/97.jpg",
                "description": "Ut ut voluptas dolores dolorem.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 29,
            "first_name": "Kacey",
            "last_name": "Earline",
            "username": "cora3558",
            "email": "fnader@example.org",
            "phone": "914-501-3561 x652",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 29,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 29,
                "user_id": 29,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/94.jpg",
                "description": "Velit non natus rem nemo et consectetur laudantium saepe.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 28,
            "first_name": "Antoinette",
            "last_name": "Liliana",
            "username": "quigley.carmelo22",
            "email": "ladarius.hagenes@example.net",
            "phone": "1-475-595-6968 x625",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 28,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 28,
                "user_id": 28,
                "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                "description": "Saepe enim eum tempora quos ullam.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 27,
            "first_name": "Leta",
            "last_name": "Geovany",
            "username": "destinee.emard13",
            "email": "ruthe97@example.com",
            "phone": "(596) 438-6092",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 27,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 27,
                "user_id": 27,
                "image": "https:\/\/randomuser.me\/api\/portraits\/men\/96.jpg",
                "description": "Tempore soluta ut quis vitae et sit.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        },
        {
            "id": 26,
            "first_name": "Charlene",
            "last_name": "Jessie",
            "username": "wbatz86",
            "email": "jerrell.bayer@example.org",
            "phone": "1-381-669-8157 x57143",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-09-22T13:23:59.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-09-22T13:23:59.000000Z",
            "updated_at": "2020-09-22T13:23:59.000000Z",
            "rating": null,
            "isActive": false,
            "lastSeen": null,
            "amount": 0,
            "pivot": {
                "business_id": 1,
                "user_id": 26,
                "role_id": 2,
                "apn_token": null,
                "fcm_token": null,
                "email_notifications": true,
                "sms_notifications": true,
                "push_notifications": true
            },
            "profile": {
                "id": 26,
                "user_id": 26,
                "image": "https:\/\/randomuser.me\/api\/portraits\/women\/98.jpg",
                "description": "Numquam sit distinctio sed voluptatibus possimus.",
                "created_at": "2020-09-22T13:23:59.000000Z",
                "updated_at": "2020-09-22T13:23:59.000000Z"
            }
        }
    ]
}

```


