# Calendar

Show a list of events on a business&#039;s calendar.

---

- [Show Events](#show-events)



<a name="show-events"></a>
## Show Events

Show a list of events for a business&#039;s calendar.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/calendar`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show a list of events",
    "data": [
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Destini Kohler Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Lois Deckow Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Mr. Candido Streich Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Helena Terry Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Rusty Weimann Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Olga Halvorson Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Shawna Lebsack Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Iliana Hermiston Job",
            "theme": "yellow"
        },
        {
            "date": "2020-09-23T00:00:00+00:00",
            "title": "Janick Veum Job",
            "theme": "yellow"
        }
    ]
}

```


