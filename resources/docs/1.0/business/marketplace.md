# Marketplace

These routes manage the company&#039;s marketplace.

---

- [All Jobs](#all-jobs)


- [Show job](#show-job)



<a name="all-jobs"></a>
## All Jobs

View all jobs in a business marketplace.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/jobs`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show all marketplace jobs",
    "data": [
        {
            "id": 1,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 39,
            "description": "Illo amet quo corrupti quia. Quod iste sit quia ut sit aliquam deserunt.",
            "status_id": 1,
            "intensity_id": 3,
            "complete_before": "2020-06-25 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-06-24T14:33:36.000000Z",
            "updated_at": "2020-06-24T14:33:36.000000Z",
            "deleted_at": null,
            "status": "Requested",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Constance",
                "last_name": "Ana",
                "username": "admin_one",
                "email": "tillman.aurelie@example.com",
                "phone": "251.293.0528 x33200",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-06-24T14:33:34.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                    "description": "Labore est sed laborum nesciunt.",
                    "created_at": "2020-06-24T14:33:34.000000Z",
                    "updated_at": "2020-06-24T14:33:34.000000Z"
                }
            },
            "proposals": [],
            "category": {
                "id": 1,
                "name": "Assembly",
                "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
            },
            "job_status": {
                "id": 1,
                "name": "Requested"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 2,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 47,
            "description": "Et neque consequatur libero a quaerat odit. Maiores dolore aut ut distinctio vel sunt.",
            "status_id": 2,
            "intensity_id": 3,
            "complete_before": "2020-06-25 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-06-24T14:33:36.000000Z",
            "updated_at": "2020-06-24T14:33:36.000000Z",
            "deleted_at": null,
            "status": "Pending Approval",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Constance",
                "last_name": "Ana",
                "username": "admin_one",
                "email": "tillman.aurelie@example.com",
                "phone": "251.293.0528 x33200",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-06-24T14:33:34.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                    "description": "Labore est sed laborum nesciunt.",
                    "created_at": "2020-06-24T14:33:34.000000Z",
                    "updated_at": "2020-06-24T14:33:34.000000Z"
                }
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
                    "created_at": "2020-06-24T14:33:36.000000Z",
                    "updated_at": "2020-06-24T14:33:36.000000Z",
                    "status": "Pending",
                    "user": {
                        "id": 2,
                        "first_name": "Paxton",
                        "last_name": "Clementina",
                        "username": "worker_one",
                        "email": "preston50@example.net",
                        "phone": "273.720.3041 x89067",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-06-24T14:33:34.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-06-24T14:33:34.000000Z",
                        "updated_at": "2020-06-24T14:33:34.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/97.jpg",
                            "description": "Ratione veritatis doloribus reiciendis qui et.",
                            "created_at": "2020-06-24T14:33:34.000000Z",
                            "updated_at": "2020-06-24T14:33:34.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 1,
                        "name": "Pending"
                    }
                }
            ],
            "category": {
                "id": 1,
                "name": "Assembly",
                "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
            },
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
            "price": 35,
            "description": "Repellendus harum voluptatum voluptatem consequatur consequatur harum laudantium error. Esse et est vel necessitatibus officia.",
            "status_id": 3,
            "intensity_id": 3,
            "complete_before": "2020-06-25 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-06-24T14:33:36.000000Z",
            "updated_at": "2020-06-24T14:33:36.000000Z",
            "deleted_at": null,
            "status": "Approved",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Constance",
                "last_name": "Ana",
                "username": "admin_one",
                "email": "tillman.aurelie@example.com",
                "phone": "251.293.0528 x33200",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-06-24T14:33:34.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                    "description": "Labore est sed laborum nesciunt.",
                    "created_at": "2020-06-24T14:33:34.000000Z",
                    "updated_at": "2020-06-24T14:33:34.000000Z"
                }
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
                    "created_at": "2020-06-24T14:33:36.000000Z",
                    "updated_at": "2020-06-24T14:33:36.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Paxton",
                        "last_name": "Clementina",
                        "username": "worker_one",
                        "email": "preston50@example.net",
                        "phone": "273.720.3041 x89067",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-06-24T14:33:34.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-06-24T14:33:34.000000Z",
                        "updated_at": "2020-06-24T14:33:34.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/97.jpg",
                            "description": "Ratione veritatis doloribus reiciendis qui et.",
                            "created_at": "2020-06-24T14:33:34.000000Z",
                            "updated_at": "2020-06-24T14:33:34.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "category": {
                "id": 1,
                "name": "Assembly",
                "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
            },
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
            "price": 10,
            "description": "Minus quod fuga culpa eos ipsum vel. Excepturi eos saepe in et provident laudantium id saepe.",
            "status_id": 4,
            "intensity_id": 3,
            "complete_before": "2020-06-25 00:00:00",
            "views": 0,
            "image_one": "https:\/\/blogs.massaudubon.org\/yourgreatoutdoors\/wp-content\/uploads\/sites\/20\/2012\/08\/Kristin-FrontYard-EarlySpring-Small-2.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-06-24T14:33:36.000000Z",
            "updated_at": "2020-06-24T14:33:36.000000Z",
            "deleted_at": null,
            "status": "In Progress",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Constance",
                "last_name": "Ana",
                "username": "admin_one",
                "email": "tillman.aurelie@example.com",
                "phone": "251.293.0528 x33200",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-06-24T14:33:34.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                    "description": "Labore est sed laborum nesciunt.",
                    "created_at": "2020-06-24T14:33:34.000000Z",
                    "updated_at": "2020-06-24T14:33:34.000000Z"
                }
            },
            "proposals": [
                {
                    "id": 3,
                    "marketplace_id": 4,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": "2020-06-24 00:00:00",
                    "completed_at": null,
                    "created_at": "2020-06-24T14:33:36.000000Z",
                    "updated_at": "2020-06-24T14:33:36.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Paxton",
                        "last_name": "Clementina",
                        "username": "worker_one",
                        "email": "preston50@example.net",
                        "phone": "273.720.3041 x89067",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-06-24T14:33:34.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-06-24T14:33:34.000000Z",
                        "updated_at": "2020-06-24T14:33:34.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/97.jpg",
                            "description": "Ratione veritatis doloribus reiciendis qui et.",
                            "created_at": "2020-06-24T14:33:34.000000Z",
                            "updated_at": "2020-06-24T14:33:34.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "category": {
                "id": 1,
                "name": "Assembly",
                "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
            },
            "job_status": {
                "id": 4,
                "name": "In Progress"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        },
        {
            "id": 5,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "price": 33,
            "description": "Nulla fugiat ducimus et. Recusandae suscipit accusamus ex necessitatibus et et.",
            "status_id": 5,
            "intensity_id": 3,
            "complete_before": "2020-06-25 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-06-24T14:33:38.000000Z",
            "updated_at": "2020-06-24T14:33:38.000000Z",
            "deleted_at": null,
            "status": "Complete",
            "intensity": "Hard",
            "customer": {
                "id": 1,
                "first_name": "Constance",
                "last_name": "Ana",
                "username": "admin_one",
                "email": "tillman.aurelie@example.com",
                "phone": "251.293.0528 x33200",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-06-24T14:33:34.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 1,
                    "user_id": 1,
                    "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                    "description": "Labore est sed laborum nesciunt.",
                    "created_at": "2020-06-24T14:33:34.000000Z",
                    "updated_at": "2020-06-24T14:33:34.000000Z"
                }
            },
            "proposals": [
                {
                    "id": 4,
                    "marketplace_id": 5,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": "5",
                    "review": "Good job!",
                    "arrived_at": "2020-06-24 00:00:00",
                    "completed_at": "2020-06-23 23:00:00",
                    "created_at": "2020-06-24T14:33:38.000000Z",
                    "updated_at": "2020-06-24T14:33:38.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Paxton",
                        "last_name": "Clementina",
                        "username": "worker_one",
                        "email": "preston50@example.net",
                        "phone": "273.720.3041 x89067",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-06-24T14:33:34.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-06-24T14:33:34.000000Z",
                        "updated_at": "2020-06-24T14:33:34.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/97.jpg",
                            "description": "Ratione veritatis doloribus reiciendis qui et.",
                            "created_at": "2020-06-24T14:33:34.000000Z",
                            "updated_at": "2020-06-24T14:33:34.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "category": {
                "id": 1,
                "name": "Assembly",
                "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
            },
            "job_status": {
                "id": 5,
                "name": "Complete"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard"
            }
        }
    ]
}

```



<a name="show-job"></a>
## Show job

Show a single job in a business marketplace.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/job/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show single job",
    "data": {
        "id": 1,
        "business_id": 1,
        "customer_id": 1,
        "category_id": 1,
        "price": 39,
        "description": "Illo amet quo corrupti quia. Quod iste sit quia ut sit aliquam deserunt.",
        "status_id": 1,
        "intensity_id": 3,
        "complete_before": "2020-06-25 00:00:00",
        "views": 0,
        "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
        "image_two": null,
        "image_three": null,
        "created_at": "2020-06-24T14:33:36.000000Z",
        "updated_at": "2020-06-24T14:33:36.000000Z",
        "deleted_at": null,
        "status": "Requested",
        "intensity": "Hard",
        "customer": {
            "id": 1,
            "first_name": "Constance",
            "last_name": "Ana",
            "username": "admin_one",
            "email": "tillman.aurelie@example.com",
            "phone": "251.293.0528 x33200",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-06-24T14:33:34.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-06-24T14:33:34.000000Z",
            "updated_at": "2020-06-24T14:33:34.000000Z",
            "isActive": false,
            "lastSeen": null,
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/randomuser.me\/api\/portraits\/men\/91.jpg",
                "description": "Labore est sed laborum nesciunt.",
                "created_at": "2020-06-24T14:33:34.000000Z",
                "updated_at": "2020-06-24T14:33:34.000000Z"
            }
        },
        "proposals": [],
        "category": {
            "id": 1,
            "name": "Assembly",
            "icon_image": "https:\/\/favr-images.s3.us-east-2.amazonaws.com\/categories\/gear.png"
        },
        "location": {
            "id": 1,
            "marketplace_id": 1,
            "street_address": "5500 Bandel Rd NW",
            "city": "Rochester",
            "state": "MN",
            "zip": "55901",
            "lat": 44.08027,
            "long": -92.50504
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
}

```


