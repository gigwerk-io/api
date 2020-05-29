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
            "id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
            "business_id": 1,
            "users": [
                "admin_one",
                "worker_one"
            ],
            "created_at": "2020-05-28T23:37:00.000000Z",
            "updated_at": "2020-05-28T23:37:00.000000Z",
            "unread": 2,
            "messages": [
                {
                    "id": 1,
                    "chat_room_id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
                    "sender_id": 1,
                    "text": "Reprehenderit sapiente labore vel ducimus. Facilis magni exercitationem omnis modi quia est.",
                    "read": false,
                    "created_at": "2020-05-28T23:37:00.000000Z",
                    "updated_at": "2020-05-28T23:37:00.000000Z"
                },
                {
                    "id": 2,
                    "chat_room_id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
                    "sender_id": 2,
                    "text": "Quo eum et in sed eligendi. Nam aut officia maxime quod.",
                    "read": false,
                    "created_at": "2020-05-28T23:37:00.000000Z",
                    "updated_at": "2020-05-28T23:37:00.000000Z"
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
        "id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
        "business_id": 1,
        "users": [
            "admin_one",
            "worker_one"
        ],
        "created_at": "2020-05-28T23:37:00.000000Z",
        "updated_at": "2020-05-28T23:37:00.000000Z",
        "messages": [
            {
                "id": 1,
                "chat_room_id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
                "sender_id": 1,
                "text": "Reprehenderit sapiente labore vel ducimus. Facilis magni exercitationem omnis modi quia est.",
                "read": false,
                "created_at": "2020-05-28T23:37:00.000000Z",
                "updated_at": "2020-05-28T23:37:00.000000Z",
                "sender": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
                }
            },
            {
                "id": 2,
                "chat_room_id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
                "sender_id": 2,
                "text": "Quo eum et in sed eligendi. Nam aut officia maxime quod.",
                "read": false,
                "created_at": "2020-05-28T23:37:00.000000Z",
                "updated_at": "2020-05-28T23:37:00.000000Z",
                "sender": {
                    "id": 2,
                    "first_name": "Marco",
                    "last_name": "Neva",
                    "username": "worker_one",
                    "email": "price72@example.com",
                    "phone": "270-970-3273 x92163",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 2,
                        "user_id": 2,
                        "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                        "description": "Et autem et impedit ea voluptatem.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
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
        "id": "cbe27e22-68e8-4ee3-b4dd-0eb259d1a2bc"
    }
}

```


