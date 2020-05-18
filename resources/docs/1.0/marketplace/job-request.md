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
    "message": "Favr Successfully Posted!",
    "data": {
        "id": 101
    }
}

```



### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/marketplace/job/{id}`|`true`|





