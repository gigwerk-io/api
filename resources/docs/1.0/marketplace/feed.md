# Feed

These routes are responsible for viewing jobs on the feed or your own jobs.

---

- [Job Feed](#feed)


- [My Job Requests](#customer-jobs)


- [My Proposals](#worker-jobs)


- [Show Job](#view-job)



<a name="feed"></a>
## Job Feed

View the active jobs on the marketplace feed
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/marketplace/feed`|`true`|

### Query Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`lat`|`float`|`optional`|`The latitude of the users viewing the feed.`|
|`long`|`float`|`optional`|`The longitude of the users viewing the feed.`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Showing job feed",
    "data": [
        {
            "id": 1,
            "business_id": 1,
            "customer_id": 2,
            "category_id": 1,
            "price": 19,
            "description": "Quo eum incidunt unde ut. Maxime officia officia rem ullam.",
            "status_id": 1,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 1,
            "distance_away": 2.2,
            "status": "Requested",
            "intensity": "Hard",
            "customer": {
                "id": 2,
                "first_name": "Chanelle",
                "last_name": "Jeramy",
                "username": "business_worker",
                "email": "qconroy@example.org",
                "phone": "(247) 232-2332 x584",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 2,
                    "user_id": 2,
                    "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                    "description": "Unde aut ipsam deleniti modi.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "job_status": {
                "id": 1,
                "name": "Requested"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        }
    ]
}

```



<a name="customer-jobs"></a>
## My Job Requests

Show a customers requested jobs.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/marketplace/me`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Showing my jobs as a customer",
    "data": [
        {
            "id": 2,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 16,
            "description": "Delectus aut pariatur tempore ipsa. Minus nemo cumque quibusdam.",
            "status_id": 2,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 1,
            "status": "Pending Approval",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 2,
                "marketplace_id": 2,
                "street_address": "1420 11th Ave SE",
                "city": "Rochester",
                "state": "MN",
                "zip": "55904",
                "lat": 44.003899,
                "long": -92.446198
            },
            "proposals": [
                {
                    "id": 1,
                    "marketplace_id": 2,
                    "user_id": 2,
                    "status_id": 1,
                    "rating": null,
                    "review": null,
                    "arrived_at": null,
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Pending",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 1,
                        "name": "Pending"
                    }
                }
            ],
            "job_status": {
                "id": 2,
                "name": "Pending Approval"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 3,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 36,
            "description": "Quibusdam quibusdam perferendis porro tempore qui omnis. Et quaerat est qui.",
            "status_id": 3,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/blogs.massaudubon.org\/yourgreatoutdoors\/wp-content\/uploads\/sites\/20\/2012\/08\/Kristin-FrontYard-EarlySpring-Small-2.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 1,
            "status": "Approved",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 3,
                "marketplace_id": 3,
                "street_address": "200 1st St SW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55905",
                "lat": 44.02243,
                "long": -92.466751
            },
            "proposals": [
                {
                    "id": 2,
                    "marketplace_id": 3,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": null,
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 3,
                "name": "Approved"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 4,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 38,
            "description": "Magni odio perspiciatis omnis unde alias. Dignissimos quis enim mollitia cum quasi quaerat perferendis.",
            "status_id": 4,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 9,
            "status": "In Progress",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 4,
                "marketplace_id": 4,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
            },
            "proposals": [
                {
                    "id": 3,
                    "marketplace_id": 4,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": "2020-05-19 00:00:00",
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 4,
                "name": "In Progress"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        }
    ]
}

```



<a name="worker-jobs"></a>
## My Proposals

The active/past proposals a worker has made on jobs.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/marketplace/proposals`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Showing my proposals as a worker",
    "data": [
        {
            "id": 2,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 16,
            "description": "Delectus aut pariatur tempore ipsa. Minus nemo cumque quibusdam.",
            "status_id": 2,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 3,
            "status": "Pending Approval",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 2,
                "marketplace_id": 2,
                "street_address": "1420 11th Ave SE",
                "city": "Rochester",
                "state": "MN",
                "zip": "55904",
                "lat": 44.003899,
                "long": -92.446198
            },
            "proposals": [
                {
                    "id": 1,
                    "marketplace_id": 2,
                    "user_id": 2,
                    "status_id": 1,
                    "rating": null,
                    "review": null,
                    "arrived_at": null,
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Pending",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 1,
                        "name": "Pending"
                    }
                }
            ],
            "job_status": {
                "id": 2,
                "name": "Pending Approval"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 3,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 36,
            "description": "Quibusdam quibusdam perferendis porro tempore qui omnis. Et quaerat est qui.",
            "status_id": 3,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/blogs.massaudubon.org\/yourgreatoutdoors\/wp-content\/uploads\/sites\/20\/2012\/08\/Kristin-FrontYard-EarlySpring-Small-2.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 5,
            "status": "Approved",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 3,
                "marketplace_id": 3,
                "street_address": "200 1st St SW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55905",
                "lat": 44.02243,
                "long": -92.466751
            },
            "proposals": [
                {
                    "id": 2,
                    "marketplace_id": 3,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": null,
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 3,
                "name": "Approved"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 4,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 38,
            "description": "Magni odio perspiciatis omnis unde alias. Dignissimos quis enim mollitia cum quasi quaerat perferendis.",
            "status_id": 4,
            "intensity_id": 3,
            "complete_before": "2020-05-20 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "deleted_at": null,
            "action": 6,
            "status": "In Progress",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Joe",
                "last_name": "Ruben",
                "username": "business_admin",
                "email": "enrique.spinka@example.net",
                "phone": "559-230-4545",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-19T04:56:09.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z",
                "isActive": false,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Quas minima nemo ipsa quis.",
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z"
                }
            },
            "location": {
                "id": 4,
                "marketplace_id": 4,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
            },
            "proposals": [
                {
                    "id": 3,
                    "marketplace_id": 4,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": "2020-05-19 00:00:00",
                    "completed_at": null,
                    "created_at": "2020-05-19T04:56:09.000000Z",
                    "updated_at": "2020-05-19T04:56:09.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Chanelle",
                        "last_name": "Jeramy",
                        "username": "business_worker",
                        "email": "qconroy@example.org",
                        "phone": "(247) 232-2332 x584",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-05-19T04:56:09.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-05-19T04:56:09.000000Z",
                        "updated_at": "2020-05-19T04:56:09.000000Z",
                        "isActive": false,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                            "description": "Unde aut ipsam deleniti modi.",
                            "created_at": "2020-05-19T04:56:09.000000Z",
                            "updated_at": "2020-05-19T04:56:09.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 4,
                "name": "In Progress"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        }
    ]
}

```



<a name="view-job"></a>
## Show Job

Show the details of a single job request.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/marketplace/job/{id}`|`true`|

### Query Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`lat`|`float`|`optional`|`The latitude of the user viewing the feed.`|
|`long`|`float`|`optional`|`The longitude of the user viewing the feed.`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Showing a job",
    "data": {
        "id": 1,
        "business_id": 1,
        "customer_id": 2,
        "category_id": 1,
        "price": 19,
        "description": "Quo eum incidunt unde ut. Maxime officia officia rem ullam.",
        "status_id": 1,
        "intensity_id": 3,
        "complete_before": "2020-05-20 00:00:00",
        "views": 0,
        "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
        "image_two": null,
        "image_three": null,
        "created_at": "2020-05-19T04:56:09.000000Z",
        "updated_at": "2020-05-19T04:56:09.000000Z",
        "deleted_at": null,
        "distance_away": 2.2,
        "action": 1,
        "status": "Requested",
        "intensity": "Hard",
        "customer": {
            "id": 2,
            "first_name": "Chanelle",
            "last_name": "Jeramy",
            "username": "business_worker",
            "email": "qconroy@example.org",
            "phone": "(247) 232-2332 x584",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-19T04:56:09.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-19T04:56:09.000000Z",
            "updated_at": "2020-05-19T04:56:09.000000Z",
            "isActive": false,
            "profile": {
                "id": 2,
                "user_id": 2,
                "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                "description": "Unde aut ipsam deleniti modi.",
                "created_at": "2020-05-19T04:56:09.000000Z",
                "updated_at": "2020-05-19T04:56:09.000000Z"
            }
        },
        "location": {
            "id": 1,
            "marketplace_id": 1,
            "street_address": "200 1st St SW",
            "city": "Rochester",
            "state": "MN",
            "zip": "55905",
            "lat": 44.02243,
            "long": -92.466751
        },
        "proposals": [],
        "job_status": {
            "id": 1,
            "name": "Requested"
        },
        "job_intensity": {
            "id": 3,
            "name": "Hard"
        }
    }
}

```


