# Blog

These routes are responsible for the wink blog.

---

- [All Blog Posts](#all-posts)


- [All Blog Posts](#all-posts)



<a name="all-posts"></a>
## All Blog Posts

View all of the wink blog posts.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/blog-posts`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Blog posts found.",
    "data": [
        {
            "id": "0416b0c4-02c9-365f-9927-f8303e4381b9",
            "slug": "amet-perspiciatis-quam-quae-consequatur-quasi-vel-sint",
            "title": "Miss",
            "excerpt": "Rerum voluptas inventore sapiente quia.",
            "body": "Ipsam sed et et omnis. Molestiae voluptatem perferendis beatae perferendis. Reprehenderit culpa qui sunt enim eveniet. Aut maxime omnis exercitationem totam velit vero.",
            "published": true,
            "publish_date": "2020-08-20 16:08:26",
            "featured_image": "https:\/\/lorempixel.com\/640\/480\/?81210",
            "featured_image_caption": "Corrupti veniam consequatur facere et vel.",
            "author_id": "31e18df4-a120-3283-a368-ad214e0286a1",
            "created_at": "2020-08-20 16:08:26",
            "updated_at": "2020-08-20 16:08:26",
            "meta": null,
            "markdown": true,
            "author": {
                "id": "31e18df4-a120-3283-a368-ad214e0286a1",
                "slug": "Libero amet et nesciunt dolorum sed.",
                "name": "Hipolito Kris",
                "email": "bogan.lew@okon.com",
                "bio": "Dolor sint dolorem voluptatem est.",
                "avatar": "https:\/\/secure.gravatar.com\/avatar\/dcbd00d5dfc0ba3bb6c7629c81409914?s=80",
                "created_at": "2020-08-20T16:08:26.000000Z",
                "updated_at": "2020-08-20T16:08:26.000000Z",
                "meta": null
            },
            "tags": []
        }
    ]
}

```



<a name="all-posts"></a>
## All Blog Posts

View all of the wink blog posts.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/blog-post/{id}`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Blog post found.",
    "data": {
        "id": "61f44dba-bb6c-3c79-9a30-335dd24e68af",
        "slug": "molestiae-at-consequatur-perspiciatis-eveniet-rerum-saepe",
        "title": "Dr.",
        "excerpt": "Dolor omnis explicabo et quibusdam sint qui nihil.",
        "body": "Quis sed aut qui voluptas quae doloremque perspiciatis. Nihil in doloremque rem repellendus expedita voluptatum impedit quae. Temporibus suscipit exercitationem ut modi eos animi sint.",
        "published": true,
        "publish_date": "2020-08-20 16:25:20",
        "featured_image": "https:\/\/lorempixel.com\/640\/480\/?23666",
        "featured_image_caption": "Consequatur consequatur voluptas ut dolores et delectus necessitatibus.",
        "author_id": "85dba02d-b684-390a-b319-d20efbb835ad",
        "created_at": "2020-08-20 16:25:20",
        "updated_at": "2020-08-20 16:25:20",
        "meta": null,
        "markdown": true,
        "author": {
            "id": "85dba02d-b684-390a-b319-d20efbb835ad",
            "slug": "Molestias et amet ut neque laudantium numquam.",
            "name": "Prof. Paris O'Hara II",
            "email": "rosenbaum.davin@yahoo.com",
            "bio": "Excepturi vel enim enim voluptatem aut aut.",
            "avatar": "https:\/\/secure.gravatar.com\/avatar\/1297f641fe0aebbbcff3ee8a93a89960?s=80",
            "created_at": "2020-08-20T16:25:20.000000Z",
            "updated_at": "2020-08-20T16:25:20.000000Z",
            "meta": null
        },
        "tags": []
    }
}

```


