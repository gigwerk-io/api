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
            "id": "fba5cb80-e87c-33b2-bd94-0fd513548c33",
            "slug": "foo",
            "title": "Prof.",
            "excerpt": "Qui voluptatum incidunt omnis soluta perferendis sit.",
            "body": "Fuga odit voluptatem animi velit. Omnis adipisci reprehenderit commodi rerum molestias. Provident rerum cumque iste optio.",
            "published": true,
            "publish_date": "2020-09-22 13:30:45",
            "featured_image": "https:\/\/lorempixel.com\/640\/480\/?97935",
            "featured_image_caption": "Minus reiciendis libero illum non.",
            "author_id": "a22c0451-dacb-33f1-8d9f-65e4f8215964",
            "created_at": "2020-09-22 13:30:45",
            "updated_at": "2020-09-22 13:30:45",
            "meta": null,
            "markdown": true,
            "author": {
                "id": "a22c0451-dacb-33f1-8d9f-65e4f8215964",
                "slug": "Quo id amet voluptas voluptatibus doloribus ut cum.",
                "name": "Miss Janiya Morar DVM",
                "email": "sspinka@ryan.biz",
                "bio": "Dolores nisi animi ea soluta et architecto voluptas.",
                "avatar": "https:\/\/secure.gravatar.com\/avatar\/7bd527e470e163aa99b5aa80073c17db?s=80",
                "created_at": "2020-09-22T13:30:45.000000Z",
                "updated_at": "2020-09-22T13:30:45.000000Z",
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
|`GET`|`/blog-post/{slug}`|`false`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Blog post found.",
    "data": {
        "id": "fbff27f3-98a6-3425-babf-5b079b6d8857",
        "slug": "foo",
        "title": "Dr.",
        "excerpt": "Sint hic laboriosam est sed.",
        "body": "Quae cum eligendi rerum error. Exercitationem recusandae voluptatem facere possimus voluptas. Dolorem omnis vel et quo est.",
        "published": true,
        "publish_date": "2020-09-22 13:30:46",
        "featured_image": "https:\/\/lorempixel.com\/640\/480\/?82944",
        "featured_image_caption": "Consequatur corrupti in et temporibus.",
        "author_id": "8b871e64-7fcc-33e1-81da-8e779a8f8fd1",
        "created_at": "2020-09-22 13:30:46",
        "updated_at": "2020-09-22 13:30:46",
        "meta": null,
        "markdown": true,
        "author": {
            "id": "8b871e64-7fcc-33e1-81da-8e779a8f8fd1",
            "slug": "Atque iure rerum voluptate officiis in sed officiis molestiae.",
            "name": "Dr. Delphine Kreiger Jr.",
            "email": "emmett.bogisich@gmail.com",
            "bio": "Maiores laborum molestias soluta numquam.",
            "avatar": "https:\/\/secure.gravatar.com\/avatar\/0224eb1e9bc6dd74daefd2ca214091bf?s=80",
            "created_at": "2020-09-22T13:30:46.000000Z",
            "updated_at": "2020-09-22T13:30:46.000000Z",
            "meta": null
        },
        "tags": []
    }
}

```


