# Message

Manage the messages for users

---

- [Send Message](#send-message)



<a name="send-message"></a>
## Send Message

Send a message to another user.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/message/{room_id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Message sent",
    "data": {
        "sender_id": 1,
        "text": "Foo bar",
        "chat_room_id": "049ab3ca-c18d-4d5a-864b-f106ad5d0857",
        "updated_at": "2020-05-29T12:56:11.000000Z",
        "created_at": "2020-05-29T12:56:11.000000Z",
        "id": 4
    }
}

```


