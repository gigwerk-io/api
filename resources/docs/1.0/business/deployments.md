# Deployments

Manage a businesses app deployments.

---

- [All Deployments](#all-deployments)


- [Queue Deployment](#queue-deployment)



<a name="all-deployments"></a>
## All Deployments

List out all of a businesses app deployments.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/deployments`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show deployments",
    "data": [
        {
            "id": "9c670d4c-3916-4da1-8b0f-dc0ef0c4b991",
            "business_id": 1,
            "deployment_status_id": 2,
            "start_time": "2020-09-22T13:30:16.000000Z",
            "end_time": null,
            "created_at": "2020-09-22T13:30:16.000000Z",
            "updated_at": "2020-09-22T13:30:16.000000Z",
            "build_time": null,
            "status": "Processing"
        }
    ]
}

```



<a name="queue-deployment"></a>
## Queue Deployment

Queue a deployment to be built later.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/deployment`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Deployment has been queued.",
    "data": null
}

```


