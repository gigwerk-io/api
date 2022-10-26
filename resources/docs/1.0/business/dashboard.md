# Dashboard

This allows you to view statistics and performance of their marketplaces

---

- [Metrics](#metrics)


- [Graphs](#graphs)



<a name="metrics"></a>
## Metrics

Show a list of metrics to display as cards on the dashboard.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/metrics`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show metrics",
    "data": {
        "applications": {
            "dataset": [
                0,
                0,
                0,
                0,
                0,
                0,
                37
            ],
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "total": 37,
            "percentage": 0.972972972972973
        },
        "workers": {
            "dataset": [
                0,
                0,
                0,
                0,
                0,
                0,
                29
            ],
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "total": 29,
            "percentage": 0.9655172413793104
        },
        "jobs": {
            "dataset": [
                0,
                0,
                0,
                0,
                0,
                0,
                5
            ],
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "total": 5,
            "percentage": 0.8
        },
        "hiring": {
            "dataset": [
                0,
                0,
                0,
                0,
                0,
                0,
                0.7567567567567568
            ],
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "total": 0.7567567567567568,
            "percentage": -0.3214285714285714
        }
    }
}

```



<a name="graphs"></a>
## Graphs

Get the graph data to present on the business dashboard.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/graphs`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show graph data",
    "data": {
        "jobs": {
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "datasets": [
                {
                    "label": "Jobs",
                    "data": [
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        5
                    ]
                }
            ]
        },
        "payments": {
            "labels": [
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep"
            ],
            "datasets": [
                {
                    "label": "Payments",
                    "data": [
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        57
                    ]
                }
            ]
        }
    }
}

```


