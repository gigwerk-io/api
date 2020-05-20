# Customer Actions

These routes belong are responsible for managing customer actions on a job.

---

- [Approve Freelancer](#approve)


- [Reject Worker](#reject)


- [Cancel Job](#cancel)


- [Review Freelancer](#complete)



<a name="approve"></a>
## Approve Freelancer

Accept a freelancers proposal on a job.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/approve/{freelancer_id}`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You have approved this worker",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "This worker does not have a proposal for this job.",
    "data": null
}

```



<a name="reject"></a>
## Reject Worker

Reject a workers proposal on a job.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/reject/{freelancer_id}`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You have rejected this worker",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "This worker does not have a proposal for this job.",
    "data": null
}

```



<a name="cancel"></a>
## Cancel Job

Remove a job from the marketplace feed.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/business/{unique_id}/marketplace/job/{id}`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your request has been deleted.",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "You can not cancel a job that is in progress",
    "data": null
}

```



<a name="complete"></a>
## Review Freelancer

Review the freelancer and mark the job as complete.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/review`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`rating`|`number`|`required`|`The rating of the freelancer on the job.`|
|`review`|`string`|`optional`|`The review of the freelancer on the job. example`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "This job has been marked complete",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "Illegal status transition.",
    "data": null
}

```


