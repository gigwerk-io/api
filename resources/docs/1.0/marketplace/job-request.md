# Job Request

These routes are responsible for requesting and editing jobs.

---

- [Request Job](#submit)



<a name="submit"></a>
## Request Job

Submit a job to the marketplace feed.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`description`|`string`|`required`|`The description of the job.`|
|`complete_before`|`string`|`required`|`The deadline for the job.`|
|`street_address`|`string`|`required`|`The address of the job location`|
|`city`|`string`|`required`|`The city of the job location.`|
|`state`|`string`|`required`|`The state of the job location.`|
|`zip`|`string`|`required`|`The zip code of the job location.`|
|`category_id`|`numeric`|`required`|`The category id of the job.`|
|`intensity`|`numeric`|`required`|`The intensity id of the job.`|
|`client_name`|`string`|`required`|`The first and last name of the client.`|
|`price`|`numeric`|`required`|`The price of the job.`|
|`image_one`|`string`|`optional`|`Base64 encoded image of job.`|
|`image_two`|`string`|`optional`|`Base64 encoded image of job.`|
|`image_three`|`string`|`optional`|`Base64 encoded image of job.`|


> {success} Example Success Response
Code `201`

Content

```json
{
    "success": true,
    "message": "Job Successfully Posted!",
    "data": {
        "description": "Nisi unde rerum occaecati quae rem illo eveniet. Esse et est rerum repudiandae et.",
        "complete_before": "2020-09-22 13:30:38",
        "category_id": 1,
        "intensity_id": 2,
        "price": 25,
        "client_name": "Keanu Boyle PhD",
        "business_id": 1,
        "customer_id": 1,
        "status_id": 1,
        "updated_at": "2020-09-22T13:30:38.000000Z",
        "created_at": "2020-09-22T13:30:38.000000Z",
        "id": 10,
        "status": "Requested",
        "intensity": "Medium (2-4 hours)",
        "customer": {
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
        "business": {
            "id": 1,
            "owner_id": 1,
            "unique_id": "ea11187b-fba5-31c8-87b4-84928c0334d6",
            "name": "Weyland-Yutani Corporation",
            "is_accepting_applications": true,
            "is_approved": false,
            "subdomain_prefix": "weyland-yutani",
            "stripe_connect_id": "acct_1F7RiLBKeAbZ6utM",
            "created_at": "2020-09-22T13:23:49.000000Z",
            "updated_at": "2020-09-22T13:23:51.000000Z",
            "deleted_at": null,
            "stripe_id": "cus_I4K7grXAClDEcl",
            "card_brand": "visa",
            "card_last_four": "4242",
            "trial_ends_at": null
        },
        "job_status": {
            "id": 1,
            "name": "Requested"
        },
        "job_intensity": {
            "id": 2,
            "name": "Medium (2-4 hours)"
        }
    }
}

```


