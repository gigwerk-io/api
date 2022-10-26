# Room

Manage a user&#039;s chat rooms.

---

- [All Chat Rooms](#all-rooms)


- [View Chat Room](#single-room)


- [Create Chat Room](#create-room)



<a name="all-rooms"></a>
## All Chat Rooms

View a list of a user&#039;s chat rooms.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/rooms`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show chat rooms",
    "data": [
        {
            "id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
            "business_id": 1,
            "users": [
                "admin_one",
                "worker_one"
            ],
            "created_at": "2020-09-22T13:24:04.000000Z",
            "updated_at": "2020-09-22T13:24:04.000000Z",
            "unread": 2,
            "members": [
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
                    "isActive": false,
                    "lastSeen": null,
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
                    "id": 2,
                    "first_name": "Angelina",
                    "last_name": "Jennie",
                    "username": "worker_one",
                    "email": "worker_one@mail.com",
                    "phone": "589-200-0246",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-09-22T13:23:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-09-22T13:23:54.000000Z",
                    "updated_at": "2020-09-22T13:23:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 2,
                        "user_id": 2,
                        "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                        "description": "Molestiae consequuntur dolores omnis possimus.",
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z"
                    }
                }
            ],
            "last_message": {
                "id": 2,
                "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
                "sender_id": 2,
                "text": "Sunt dolor hic debitis ea qui possimus. Incidunt ipsa mollitia aut ea omnis.",
                "read": false,
                "created_at": "2020-09-22T13:24:04.000000Z",
                "updated_at": "2020-09-22T13:24:04.000000Z",
                "sender": {
                    "id": 2,
                    "first_name": "Angelina",
                    "last_name": "Jennie",
                    "username": "worker_one",
                    "email": "worker_one@mail.com",
                    "phone": "589-200-0246",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-09-22T13:23:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-09-22T13:23:54.000000Z",
                    "updated_at": "2020-09-22T13:23:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 2,
                        "user_id": 2,
                        "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                        "description": "Molestiae consequuntur dolores omnis possimus.",
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z"
                    }
                }
            },
            "messages": [
                {
                    "id": 1,
                    "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
                    "sender_id": 1,
                    "text": "Eveniet sit non sunt dignissimos ipsam nihil. Eum est saepe cupiditate accusamus omnis sunt error.",
                    "read": false,
                    "created_at": "2020-09-22T13:24:04.000000Z",
                    "updated_at": "2020-09-22T13:24:04.000000Z"
                },
                {
                    "id": 2,
                    "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
                    "sender_id": 2,
                    "text": "Sunt dolor hic debitis ea qui possimus. Incidunt ipsa mollitia aut ea omnis.",
                    "read": false,
                    "created_at": "2020-09-22T13:24:04.000000Z",
                    "updated_at": "2020-09-22T13:24:04.000000Z"
                }
            ]
        }
    ]
}

```



<a name="single-room"></a>
## View Chat Room

View a single chat room
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/room/{room_id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "View chat room",
    "data": {
        "id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
        "business_id": 1,
        "users": [
            "admin_one",
            "worker_one"
        ],
        "created_at": "2020-09-22T13:24:04.000000Z",
        "updated_at": "2020-09-22T13:24:04.000000Z",
        "members": [
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
                "isActive": false,
                "lastSeen": null,
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
                "id": 2,
                "first_name": "Angelina",
                "last_name": "Jennie",
                "username": "worker_one",
                "email": "worker_one@mail.com",
                "phone": "589-200-0246",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-09-22T13:23:54.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-09-22T13:23:54.000000Z",
                "updated_at": "2020-09-22T13:23:54.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 2,
                    "user_id": 2,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                    "description": "Molestiae consequuntur dolores omnis possimus.",
                    "created_at": "2020-09-22T13:23:54.000000Z",
                    "updated_at": "2020-09-22T13:23:54.000000Z"
                }
            }
        ],
        "last_message": {
            "id": 2,
            "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
            "sender_id": 2,
            "text": "Sunt dolor hic debitis ea qui possimus. Incidunt ipsa mollitia aut ea omnis.",
            "read": true,
            "created_at": "2020-09-22T13:24:04.000000Z",
            "updated_at": "2020-09-22T13:30:30.000000Z",
            "sender": {
                "id": 2,
                "first_name": "Angelina",
                "last_name": "Jennie",
                "username": "worker_one",
                "email": "worker_one@mail.com",
                "phone": "589-200-0246",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-09-22T13:23:54.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-09-22T13:23:54.000000Z",
                "updated_at": "2020-09-22T13:23:54.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 2,
                    "user_id": 2,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                    "description": "Molestiae consequuntur dolores omnis possimus.",
                    "created_at": "2020-09-22T13:23:54.000000Z",
                    "updated_at": "2020-09-22T13:23:54.000000Z"
                }
            }
        },
        "messages": [
            {
                "id": 1,
                "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
                "sender_id": 1,
                "text": "Eveniet sit non sunt dignissimos ipsam nihil. Eum est saepe cupiditate accusamus omnis sunt error.",
                "read": false,
                "created_at": "2020-09-22T13:24:04.000000Z",
                "updated_at": "2020-09-22T13:24:04.000000Z",
                "sender": {
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
                    }
                }
            },
            {
                "id": 2,
                "chat_room_id": "0f83f05a-2ad0-4026-8cab-6c1144dd702b",
                "sender_id": 2,
                "text": "Sunt dolor hic debitis ea qui possimus. Incidunt ipsa mollitia aut ea omnis.",
                "read": false,
                "created_at": "2020-09-22T13:24:04.000000Z",
                "updated_at": "2020-09-22T13:24:04.000000Z",
                "sender": {
                    "id": 2,
                    "first_name": "Angelina",
                    "last_name": "Jennie",
                    "username": "worker_one",
                    "email": "worker_one@mail.com",
                    "phone": "589-200-0246",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-09-22T13:23:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-09-22T13:23:54.000000Z",
                    "updated_at": "2020-09-22T13:23:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 2,
                        "user_id": 2,
                        "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                        "description": "Molestiae consequuntur dolores omnis possimus.",
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z"
                    }
                }
            }
        ]
    }
}

```



<a name="create-room"></a>
## Create Chat Room

Find or create a chat room between two users.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/chat/{username}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Find chat room",
    "data": {
        "id": "7c8133f9-135a-4a43-b3c6-31d07706bb1b"
    }
}

```


