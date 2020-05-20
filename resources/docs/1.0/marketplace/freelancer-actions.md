# Freelancer Actions

These routes belong are responsible for managing freelancer actions on a job.

---

- [Accept Job](#accept-job)


- [Withdraw Proposal](#withdraw)


- [Arrive To Job](#arrive)


- [Complete Job](#complete)



<a name="accept-job"></a>
## Accept Job

Propose to complete a customer job request.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/accept`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "The customer has been notified of your proposal.",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "You have already proposed on this job.",
    "data": null
}

```



<a name="withdraw"></a>
## Withdraw Proposal

Withdraw from a customers job request.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/withdraw`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "You have withdrawn from this job.",
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



<a name="arrive"></a>
## Arrive To Job

A worker has arrived to the job. This is where the customer gets charged.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/arrive`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your customer has been notified of your arrival.",
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



<a name="complete"></a>
## Complete Job

The worker has completed the job and is waiting for the customer to confirm.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/marketplace/job/{id}/complete`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your customer has been notified of your arrival.",
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


