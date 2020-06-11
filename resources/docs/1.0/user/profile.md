# Profile

Manage user profile routes and actions.

---

- [View Profile](#view-profile)


- [Search User](#search-user)


- [Edit Profile](#edit-profile)



<a name="view-profile"></a>
## View Profile

View a user&#039;s profile within a business app.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/profile/{user_id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show user profile",
    "data": {
        "id": 1,
        "first_name": "Christ",
        "last_name": "Curtis",
        "username": "admin_one",
        "email": "green.coleman@example.net",
        "phone": "+1.627.859.3025",
        "apn_token": null,
        "fcm_token": null,
        "email_verified_at": "2020-05-28T23:36:54.000000Z",
        "last_seen_at": null,
        "deleted_at": null,
        "created_at": "2020-05-28T23:36:54.000000Z",
        "updated_at": "2020-05-28T23:36:54.000000Z",
        "marketplaceJobs": [
            {
                "id": 1,
                "business_id": 1,
                "customer_id": 1,
                "category_id": 1,
                "price": 49,
                "description": "Exercitationem ut velit beatae dolor ea reiciendis. Fugiat aut expedita illo et.",
                "status_id": 1,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/blogs.massaudubon.org\/yourgreatoutdoors\/wp-content\/uploads\/sites\/20\/2012\/08\/Kristin-FrontYard-EarlySpring-Small-2.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Requested",
                "intensity": "Hard",
                "proposals": [],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
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
            },
            {
                "id": 2,
                "business_id": 1,
                "customer_id": 1,
                "category_id": 1,
                "price": 16,
                "description": "Reprehenderit sed nihil voluptatem porro veniam enim. Ut ut repellendus nisi eaque ea qui nulla.",
                "status_id": 2,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Pending Approval",
                "intensity": "Hard",
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
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Pending",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 1,
                            "name": "Pending"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 21,
                "description": "Culpa et et et architecto. Laboriosam voluptatibus ut consequatur et expedita.",
                "status_id": 3,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Approved",
                "intensity": "Hard",
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
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 19,
                "description": "Explicabo corporis possimus aut sed esse. A eaque qui illo qui quae.",
                "status_id": 4,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "In Progress",
                "intensity": "Hard",
                "proposals": [
                    {
                        "id": 3,
                        "marketplace_id": 4,
                        "user_id": 2,
                        "status_id": 2,
                        "rating": null,
                        "review": null,
                        "arrived_at": "2020-05-28 00:00:00",
                        "completed_at": null,
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 37,
                "description": "Inventore tempora dignissimos quia consequatur nam repellat. Alias ratione voluptatem inventore autem non.",
                "status_id": 5,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:57.000000Z",
                "updated_at": "2020-05-28T23:36:57.000000Z",
                "deleted_at": null,
                "status": "Complete",
                "intensity": "Hard",
                "proposals": [
                    {
                        "id": 4,
                        "marketplace_id": 5,
                        "user_id": 2,
                        "status_id": 2,
                        "rating": null,
                        "review": null,
                        "arrived_at": "2020-05-28 00:00:00",
                        "completed_at": null,
                        "created_at": "2020-05-28T23:36:57.000000Z",
                        "updated_at": "2020-05-28T23:36:57.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
        ],
        "marketplaceProposals": [],
        "isActive": false,
        "lastSeen": null,
        "pivot": {
            "business_id": 1,
            "user_id": 1,
            "role_id": 1
        },
        "marketplace_jobs": [
            {
                "id": 1,
                "business_id": 1,
                "customer_id": 1,
                "category_id": 1,
                "price": 49,
                "description": "Exercitationem ut velit beatae dolor ea reiciendis. Fugiat aut expedita illo et.",
                "status_id": 1,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/blogs.massaudubon.org\/yourgreatoutdoors\/wp-content\/uploads\/sites\/20\/2012\/08\/Kristin-FrontYard-EarlySpring-Small-2.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Requested",
                "intensity": "Hard",
                "proposals": [],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
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
            },
            {
                "id": 2,
                "business_id": 1,
                "customer_id": 1,
                "category_id": 1,
                "price": 16,
                "description": "Reprehenderit sed nihil voluptatem porro veniam enim. Ut ut repellendus nisi eaque ea qui nulla.",
                "status_id": 2,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Pending Approval",
                "intensity": "Hard",
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
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Pending",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 1,
                            "name": "Pending"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 21,
                "description": "Culpa et et et architecto. Laboriosam voluptatibus ut consequatur et expedita.",
                "status_id": 3,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "Approved",
                "intensity": "Hard",
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
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 19,
                "description": "Explicabo corporis possimus aut sed esse. A eaque qui illo qui quae.",
                "status_id": 4,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/thenewswheel.com\/wp-content\/uploads\/2018\/04\/junk-yards-pay-most-for-cars-760x507.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:56.000000Z",
                "updated_at": "2020-05-28T23:36:56.000000Z",
                "deleted_at": null,
                "status": "In Progress",
                "intensity": "Hard",
                "proposals": [
                    {
                        "id": 3,
                        "marketplace_id": 4,
                        "user_id": 2,
                        "status_id": 2,
                        "rating": null,
                        "review": null,
                        "arrived_at": "2020-05-28 00:00:00",
                        "completed_at": null,
                        "created_at": "2020-05-28T23:36:56.000000Z",
                        "updated_at": "2020-05-28T23:36:56.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
                "price": 37,
                "description": "Inventore tempora dignissimos quia consequatur nam repellat. Alias ratione voluptatem inventore autem non.",
                "status_id": 5,
                "intensity_id": 3,
                "complete_before": "2020-05-29 00:00:00",
                "views": 0,
                "image_one": "https:\/\/www.simplemost.com\/wp-content\/uploads\/2017\/01\/8320434990_4c84ea6e62_o-750x500.jpg",
                "image_two": null,
                "image_three": null,
                "created_at": "2020-05-28T23:36:57.000000Z",
                "updated_at": "2020-05-28T23:36:57.000000Z",
                "deleted_at": null,
                "status": "Complete",
                "intensity": "Hard",
                "proposals": [
                    {
                        "id": 4,
                        "marketplace_id": 5,
                        "user_id": 2,
                        "status_id": 2,
                        "rating": null,
                        "review": null,
                        "arrived_at": "2020-05-28 00:00:00",
                        "completed_at": null,
                        "created_at": "2020-05-28T23:36:57.000000Z",
                        "updated_at": "2020-05-28T23:36:57.000000Z",
                        "status": "Approved",
                        "user": {
                            "id": 2,
                            "first_name": "Marco",
                            "last_name": "Neva",
                            "username": "worker_one",
                            "email": "price72@example.com",
                            "phone": "270-970-3273 x92163",
                            "apn_token": null,
                            "fcm_token": null,
                            "email_verified_at": "2020-05-28T23:36:54.000000Z",
                            "last_seen_at": null,
                            "deleted_at": null,
                            "created_at": "2020-05-28T23:36:54.000000Z",
                            "updated_at": "2020-05-28T23:36:54.000000Z",
                            "isActive": false,
                            "lastSeen": null,
                            "profile": {
                                "id": 2,
                                "user_id": 2,
                                "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                                "description": "Et autem et impedit ea voluptatem.",
                                "created_at": "2020-05-28T23:36:54.000000Z",
                                "updated_at": "2020-05-28T23:36:54.000000Z"
                            }
                        },
                        "proposal_status": {
                            "id": 2,
                            "name": "Approved"
                        }
                    }
                ],
                "customer": {
                    "id": 1,
                    "first_name": "Christ",
                    "last_name": "Curtis",
                    "username": "admin_one",
                    "email": "green.coleman@example.net",
                    "phone": "+1.627.859.3025",
                    "apn_token": null,
                    "fcm_token": null,
                    "email_verified_at": "2020-05-28T23:36:54.000000Z",
                    "last_seen_at": null,
                    "deleted_at": null,
                    "created_at": "2020-05-28T23:36:54.000000Z",
                    "updated_at": "2020-05-28T23:36:54.000000Z",
                    "isActive": false,
                    "lastSeen": null,
                    "profile": {
                        "id": 1,
                        "user_id": 1,
                        "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                        "description": "Libero esse fuga omnis necessitatibus sunt ut.",
                        "created_at": "2020-05-28T23:36:54.000000Z",
                        "updated_at": "2020-05-28T23:36:54.000000Z"
                    }
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
        ],
        "profile": {
            "id": 1,
            "user_id": 1,
            "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
            "description": "Libero esse fuga omnis necessitatibus sunt ut.",
            "created_at": "2020-05-28T23:36:54.000000Z",
            "updated_at": "2020-05-28T23:36:54.000000Z"
        },
        "marketplace_proposals": []
    }
}

```



<a name="search-user"></a>
## Search User

Search for a user within a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/search`|`true`|

### Query Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`search`|`string`|`required`|`The search parameter for a user.`|






<a name="edit-profile"></a>
## Edit Profile

Edit a user&#039;s Gigwerk profile.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/profile`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Profile has been updated",
    "data": null
}

```


