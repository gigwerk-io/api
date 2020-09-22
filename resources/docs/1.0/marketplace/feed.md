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
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Destini Kohler",
            "price": 40,
            "description": "Laudantium dolor dolorem dicta id. At minus aliquam in consequatur.",
            "status_id": 1,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:00.000000Z",
            "updated_at": "2020-09-22T13:24:00.000000Z",
            "deleted_at": null,
            "action": 2,
            "distance_away": 2.2,
            "status": "Requested",
            "intensity": "Hard (more than 4 hours)",
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
            "job_status": {
                "id": 1,
                "name": "Requested"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard (more than 4 hours)"
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
            "id": 1,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Destini Kohler",
            "price": 40,
            "description": "Laudantium dolor dolorem dicta id. At minus aliquam in consequatur.",
            "status_id": 1,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:00.000000Z",
            "updated_at": "2020-09-22T13:24:00.000000Z",
            "deleted_at": null,
            "action": 1,
            "status": "Requested",
            "intensity": "Hard (more than 4 hours)",
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 2,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Lois Deckow",
            "price": 12,
            "description": "Aliquid dolorum quia non voluptatum. Fugiat et alias autem delectus eum.",
            "status_id": 2,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:00.000000Z",
            "updated_at": "2020-09-22T13:24:00.000000Z",
            "deleted_at": null,
            "action": 1,
            "status": "Pending Approval",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 2,
                "marketplace_id": 2,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
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
                    "created_at": "2020-09-22T13:24:00.000000Z",
                    "updated_at": "2020-09-22T13:24:00.000000Z",
                    "status": "Pending",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 3,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Mr. Candido Streich",
            "price": 16,
            "description": "Deserunt in exercitationem aut. Mollitia in aut qui eos tenetur et architecto accusantium.",
            "status_id": 3,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 1,
            "status": "Approved",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 3,
                "marketplace_id": 3,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
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
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 4,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Helena Terry",
            "price": 38,
            "description": "Numquam quos in id consequuntur. Autem quam neque quos velit qui est fuga.",
            "status_id": 4,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 9,
            "status": "In Progress",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 4,
                "marketplace_id": 4,
                "street_address": "200 1st St SW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55905",
                "lat": 44.02243,
                "long": -92.466751
            },
            "proposals": [
                {
                    "id": 3,
                    "marketplace_id": 4,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": "2020-09-22 00:00:00",
                    "completed_at": null,
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 5,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Rusty Weimann",
            "price": 19,
            "description": "Culpa optio rerum vero quis et qui. Quia et provident asperiores voluptate.",
            "status_id": 5,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 2,
            "status": "Complete",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 5,
                "marketplace_id": 5,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
            },
            "proposals": [
                {
                    "id": 4,
                    "marketplace_id": 5,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": "5",
                    "review": "Good job!",
                    "arrived_at": "2020-09-22 00:00:00",
                    "completed_at": "2020-09-21 23:00:00",
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 5,
                "name": "Complete"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard (more than 4 hours)"
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
            "client_name": "Lois Deckow",
            "price": 12,
            "description": "Aliquid dolorum quia non voluptatum. Fugiat et alias autem delectus eum.",
            "status_id": 2,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:00.000000Z",
            "updated_at": "2020-09-22T13:24:00.000000Z",
            "deleted_at": null,
            "action": 3,
            "status": "Pending Approval",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 2,
                "marketplace_id": 2,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
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
                    "created_at": "2020-09-22T13:24:00.000000Z",
                    "updated_at": "2020-09-22T13:24:00.000000Z",
                    "status": "Pending",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 3,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Mr. Candido Streich",
            "price": 16,
            "description": "Deserunt in exercitationem aut. Mollitia in aut qui eos tenetur et architecto accusantium.",
            "status_id": 3,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 5,
            "status": "Approved",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 3,
                "marketplace_id": 3,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
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
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 4,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Helena Terry",
            "price": 38,
            "description": "Numquam quos in id consequuntur. Autem quam neque quos velit qui est fuga.",
            "status_id": 4,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 6,
            "status": "In Progress",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 4,
                "marketplace_id": 4,
                "street_address": "200 1st St SW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55905",
                "lat": 44.02243,
                "long": -92.466751
            },
            "proposals": [
                {
                    "id": 3,
                    "marketplace_id": 4,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": null,
                    "review": null,
                    "arrived_at": "2020-09-22 00:00:00",
                    "completed_at": null,
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
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
                "name": "Hard (more than 4 hours)"
            }
        },
        {
            "id": 5,
            "business_id": 1,
            "customer_id": 1,
            "category_id": 1,
            "client_name": "Rusty Weimann",
            "price": 19,
            "description": "Culpa optio rerum vero quis et qui. Quia et provident asperiores voluptate.",
            "status_id": 5,
            "intensity_id": 3,
            "complete_before": "2020-09-23 00:00:00",
            "views": 0,
            "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
            "image_two": null,
            "image_three": null,
            "created_at": "2020-09-22T13:24:01.000000Z",
            "updated_at": "2020-09-22T13:24:01.000000Z",
            "deleted_at": null,
            "action": 11,
            "status": "Complete",
            "intensity": "Hard (more than 4 hours)",
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
            "location": {
                "id": 5,
                "marketplace_id": 5,
                "street_address": "5500 Bandel Rd NW",
                "city": "Rochester",
                "state": "MN",
                "zip": "55901",
                "lat": 44.08027,
                "long": -92.50504
            },
            "proposals": [
                {
                    "id": 4,
                    "marketplace_id": 5,
                    "user_id": 2,
                    "status_id": 2,
                    "rating": "5",
                    "review": "Good job!",
                    "arrived_at": "2020-09-22 00:00:00",
                    "completed_at": "2020-09-21 23:00:00",
                    "created_at": "2020-09-22T13:24:01.000000Z",
                    "updated_at": "2020-09-22T13:24:01.000000Z",
                    "status": "Approved",
                    "user": {
                        "id": 2,
                        "first_name": "Angelina",
                        "last_name": "Jennie",
                        "username": "worker_one",
                        "email": "worker_one@mail.com",
                        "phone": "589-200-0246",
                        "apn_token": null,
                        "fcm_token": null,
                        "email_verified_at": "2020-09-22T13:23:54.000000Z",
                        "last_seen_at": null,
                        "deleted_at": null,
                        "created_at": "2020-09-22T13:23:54.000000Z",
                        "updated_at": "2020-09-22T13:23:54.000000Z",
                        "isActive": false,
                        "lastSeen": null,
                        "profile": {
                            "id": 2,
                            "user_id": 2,
                            "image": "https:\/\/randomuser.me\/api\/portraits\/men\/92.jpg",
                            "description": "Molestiae consequuntur dolores omnis possimus.",
                            "created_at": "2020-09-22T13:23:54.000000Z",
                            "updated_at": "2020-09-22T13:23:54.000000Z"
                        }
                    },
                    "proposal_status": {
                        "id": 2,
                        "name": "Approved"
                    }
                }
            ],
            "job_status": {
                "id": 5,
                "name": "Complete"
            },
            "job_intensity": {
                "id": 3,
                "name": "Hard (more than 4 hours)"
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
        "customer_id": 1,
        "category_id": 1,
        "client_name": "Destini Kohler",
        "price": 40,
        "description": "Laudantium dolor dolorem dicta id. At minus aliquam in consequatur.",
        "status_id": 1,
        "intensity_id": 3,
        "complete_before": "2020-09-23 00:00:00",
        "views": 1,
        "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
        "image_two": null,
        "image_three": null,
        "created_at": "2020-09-22T13:24:00.000000Z",
        "updated_at": "2020-09-22T13:30:33.000000Z",
        "deleted_at": null,
        "distance_away": 2.2,
        "action": 2,
        "status": "Requested",
        "intensity": "Hard (more than 4 hours)",
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
        "proposals": [],
        "job_status": {
            "id": 1,
            "name": "Requested"
        },
        "job_intensity": {
            "id": 3,
            "name": "Hard (more than 4 hours)"
        }
    }
}

```


