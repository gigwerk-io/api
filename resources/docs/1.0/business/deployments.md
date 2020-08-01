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
            "id": "8282ee32-c89a-4420-9ecc-7f3bc1179c05",
            "business_id": 1,
            "deployment_status_id": 2,
            "start_time": "2020-08-01 05:50:40",
            "end_time": null,
            "created_at": "2020-08-01T05:50:40.000000Z",
            "updated_at": "2020-08-01T05:50:40.000000Z",
            "build_time": null
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
    "data": {
        "deployment_status_id": 1,
        "id": "af371c5c-bbf2-4eed-88b3-00eea68b5de9",
        "business_id": 1,
        "updated_at": "2020-08-01T05:48:52.000000Z",
        "created_at": "2020-08-01T05:48:52.000000Z",
        "build_time": null
    }
}

```


