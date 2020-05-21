# Job Request

These routes are responsible for requesting and editing jobs.

---

- [Request Job](#submit)


- [Edit Job](#edit-job)



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
|`business_id`|`string`|`required`|`The uuid of the business marketplace.`|
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
        "description": "Veniam unde cumque nulla aliquid ea accusantium inventore quasi. Mollitia et repellendus id itaque recusandae omnis.",
        "complete_before": "2020-05-21 05:50:42",
        "category_id": 1,
        "intensity_id": 2,
        "price": 25,
        "image_one": "\/marketplace\/60ebde0b-e28c-4c25-aff0-c4ebee3ca900.jpeg",
        "business_id": 1,
        "customer_id": 1,
        "status_id": 1,
        "updated_at": "2020-05-21T05:50:42.000000Z",
        "created_at": "2020-05-21T05:50:42.000000Z",
        "id": 9,
        "status": "Requested",
        "intensity": "Medium",
        "job_status": {
            "id": 1,
            "name": "Requested"
        },
        "job_intensity": {
            "id": 2,
            "name": "Medium"
        }
    }
}

```



<a name="edit-job"></a>
## Edit Job

Edit a customers marketplace job.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/marketplace/job/{id}`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`description`|`string`|`optional`|`The description of the job.`|
|`complete_before`|`string`|`optional`|`The deadline for the job.`|
|`street_address`|`string`|`optional`|`The address of the job location`|
|`city`|`string`|`optional`|`The city of the job location.`|
|`state`|`string`|`optional`|`The state of the job location.`|
|`zip`|`string`|`optional`|`The zip code of the job location.`|


> {success} Example Success Response
Code `201`

Content

```json
{
    "success": true,
    "message": "Your job has been updated.",
    "data": null
}

```


