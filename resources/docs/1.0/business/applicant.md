# Applicant

Manage all of your businesses applications &amp; applicants.

---

- [View Applicants](#all)


- [Show Applicant](#single)


- [Approve Applicant](#approve)


- [Reject Applicant](#reject)


- [Delete Application](#delete)



<a name="all"></a>
## View Applicants

Show all of the applicants in a business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/applicants`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "View all applicants",
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:00.000000Z",
            "updated_at": "2020-05-22T00:32:00.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 2,
                "first_name": "Chloe",
                "last_name": "Lilyan",
                "username": "worker_one",
                "email": "ohudson@example.com",
                "phone": "635-948-0228 x84176",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:00.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:00.000000Z",
                "updated_at": "2020-05-22T00:32:00.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 2,
                    "user_id": 2,
                    "image": "https:\/\/i.picsum.photos\/id\/521\/600\/600.jpg",
                    "description": "Animi tenetur harum excepturi et maiores quam.",
                    "created_at": "2020-05-22T00:32:00.000000Z",
                    "updated_at": "2020-05-22T00:32:00.000000Z"
                }
            }
        },
        {
            "id": 2,
            "user_id": 3,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 3,
                "first_name": "Billy",
                "last_name": "Wallace",
                "username": "pending_one",
                "email": "sglover@example.net",
                "phone": "524.471.4919 x79803",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:00.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:00.000000Z",
                "updated_at": "2020-05-22T00:32:00.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 3,
                    "user_id": 3,
                    "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                    "description": "Voluptatem incidunt dolorem omnis rerum consequuntur architecto asperiores.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 3,
            "user_id": 4,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 4,
                "first_name": "Nia",
                "last_name": "Madge",
                "username": "applicant_one",
                "email": "alford78@example.com",
                "phone": "363-992-2699 x634",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 4,
                    "user_id": 4,
                    "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                    "description": "Nihil error ut omnis dolorum quaerat sunt enim quisquam.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 8,
            "user_id": 9,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 9,
                "first_name": "Louvenia",
                "last_name": "Donnell",
                "username": "multi_user",
                "email": "enrique.wiza@example.org",
                "phone": "552-814-4767 x76343",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 9,
                    "user_id": 9,
                    "image": "https:\/\/i.picsum.photos\/id\/58\/600\/600.jpg",
                    "description": "Qui totam maxime est sunt quibusdam.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 9,
            "user_id": 10,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 10,
                "first_name": "Ahmed",
                "last_name": "Triston",
                "username": "tgrant25",
                "email": "arvilla.huels@example.org",
                "phone": "1-948-962-1290",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 10,
                    "user_id": 10,
                    "image": "https:\/\/i.picsum.photos\/id\/835\/600\/600.jpg",
                    "description": "Quia repellat aut quidem aut veniam.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 10,
            "user_id": 11,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 11,
                "first_name": "Maymie",
                "last_name": "Adelbert",
                "username": "clind90",
                "email": "lilliana79@example.net",
                "phone": "1-862-703-2648",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 11,
                    "user_id": 11,
                    "image": "https:\/\/i.picsum.photos\/id\/703\/600\/600.jpg",
                    "description": "Deserunt consequatur non perferendis expedita nesciunt.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 11,
            "user_id": 12,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 12,
                "first_name": "Buddy",
                "last_name": "Modesto",
                "username": "joanie.kohler7",
                "email": "bbotsford@example.org",
                "phone": "856-430-8473 x87946",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 12,
                    "user_id": 12,
                    "image": "https:\/\/i.picsum.photos\/id\/548\/600\/600.jpg",
                    "description": "Magnam sunt distinctio veniam ad ducimus velit.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 12,
            "user_id": 13,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 13,
                "first_name": "America",
                "last_name": "Alice",
                "username": "leann2671",
                "email": "verna33@example.org",
                "phone": "770.409.7425 x09256",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 13,
                    "user_id": 13,
                    "image": "https:\/\/i.picsum.photos\/id\/538\/640\/640.jpg",
                    "description": "Fugit ex ipsam enim aut esse.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 13,
            "user_id": 14,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 14,
                "first_name": "Chaz",
                "last_name": "Lavina",
                "username": "vcrooks6",
                "email": "vreichert@example.org",
                "phone": "562-678-2255 x267",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 14,
                    "user_id": 14,
                    "image": "https:\/\/i.picsum.photos\/id\/548\/600\/600.jpg",
                    "description": "Vel qui vitae sequi aut ipsa id.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 14,
            "user_id": 15,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 15,
                "first_name": "Susie",
                "last_name": "Renee",
                "username": "arunte58",
                "email": "frederick83@example.com",
                "phone": "851-252-1832 x8770",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 15,
                    "user_id": 15,
                    "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                    "description": "Quia ipsum sunt doloribus minus velit ipsum beatae.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 15,
            "user_id": 16,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 16,
                "first_name": "Alessia",
                "last_name": "Candelario",
                "username": "yasmin8311",
                "email": "elvera01@example.com",
                "phone": "514.692.8427 x4204",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 16,
                    "user_id": 16,
                    "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                    "description": "Modi deserunt odio et ut qui ut.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 16,
            "user_id": 17,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 17,
                "first_name": "Dax",
                "last_name": "Carolyne",
                "username": "frenner40",
                "email": "awindler@example.com",
                "phone": "271-301-4005",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 17,
                    "user_id": 17,
                    "image": "https:\/\/i.picsum.photos\/id\/1019\/600\/600.jpg",
                    "description": "Repellendus sint ut debitis dolore consectetur.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 17,
            "user_id": 18,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 18,
                "first_name": "Daisy",
                "last_name": "Aryanna",
                "username": "kovacek.andrew62",
                "email": "dbatz@example.com",
                "phone": "330-370-0348 x705",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 18,
                    "user_id": 18,
                    "image": "https:\/\/i.picsum.photos\/id\/703\/600\/600.jpg",
                    "description": "Provident et excepturi provident sint.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 18,
            "user_id": 19,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 19,
                "first_name": "Aletha",
                "last_name": "Sterling",
                "username": "gusikowski.forrest62",
                "email": "gregg.bernhard@example.org",
                "phone": "1-583-565-1539",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 19,
                    "user_id": 19,
                    "image": "https:\/\/i.picsum.photos\/id\/521\/600\/600.jpg",
                    "description": "Deleniti quod alias est praesentium qui quam.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 19,
            "user_id": 20,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 20,
                "first_name": "Anjali",
                "last_name": "Fredrick",
                "username": "garry.gleichner13",
                "email": "gulgowski.lily@example.org",
                "phone": "(947) 200-5915 x80461",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 20,
                    "user_id": 20,
                    "image": "https:\/\/i.picsum.photos\/id\/310\/600\/600.jpg",
                    "description": "Minus sed sed quibusdam qui.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 20,
            "user_id": 21,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 21,
                "first_name": "Marlee",
                "last_name": "Reanna",
                "username": "mrutherford62",
                "email": "jzemlak@example.net",
                "phone": "1-230-758-7078",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 21,
                    "user_id": 21,
                    "image": "https:\/\/i.picsum.photos\/id\/558\/600\/600.jpg",
                    "description": "Eveniet sed dicta sint asperiores velit dolorum.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 21,
            "user_id": 22,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 22,
                "first_name": "Easter",
                "last_name": "Dianna",
                "username": "keira4992",
                "email": "cristopher.weissnat@example.com",
                "phone": "+1-937-529-7673",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 22,
                    "user_id": 22,
                    "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                    "description": "Voluptatem minus nam vel necessitatibus delectus.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 22,
            "user_id": 23,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 23,
                "first_name": "Onie",
                "last_name": "Susie",
                "username": "craig225",
                "email": "hberge@example.net",
                "phone": "216-950-1375 x8282",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 23,
                    "user_id": 23,
                    "image": "https:\/\/i.picsum.photos\/id\/617\/600\/600.jpg",
                    "description": "Error qui deleniti eligendi sunt qui.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 23,
            "user_id": 24,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 24,
                "first_name": "Johathan",
                "last_name": "Adell",
                "username": "donny4992",
                "email": "wiza.shayne@example.com",
                "phone": "1-501-425-4875",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 24,
                    "user_id": 24,
                    "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                    "description": "Minima atque voluptas commodi ab dolore fugit et.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 24,
            "user_id": 25,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 25,
                "first_name": "Khalil",
                "last_name": "Ralph",
                "username": "tia.larkin72",
                "email": "gudrun12@example.org",
                "phone": "282-978-8147 x92652",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 25,
                    "user_id": 25,
                    "image": "https:\/\/i.picsum.photos\/id\/586\/600\/600.jpg",
                    "description": "Commodi iusto voluptas debitis est.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 25,
            "user_id": 26,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 26,
                "first_name": "Victor",
                "last_name": "Dixie",
                "username": "jovanny.yost23",
                "email": "owisozk@example.net",
                "phone": "(339) 417-3459",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 26,
                    "user_id": 26,
                    "image": "https:\/\/i.picsum.photos\/id\/835\/600\/600.jpg",
                    "description": "Sed cumque sapiente itaque quas.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 26,
            "user_id": 27,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 27,
                "first_name": "Maribel",
                "last_name": "Margie",
                "username": "schumm.leonie77",
                "email": "henriette86@example.org",
                "phone": "+1-725-614-3898",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 27,
                    "user_id": 27,
                    "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                    "description": "Consequuntur molestiae aliquam dolore qui.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 27,
            "user_id": 28,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 28,
                "first_name": "Rashad",
                "last_name": "Lilian",
                "username": "qledner60",
                "email": "lelia42@example.net",
                "phone": "1-449-410-9648 x57213",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 28,
                    "user_id": 28,
                    "image": "https:\/\/i.picsum.photos\/id\/521\/600\/600.jpg",
                    "description": "Eius nemo qui non illum repudiandae architecto.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 28,
            "user_id": 29,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 29,
                "first_name": "Ezequiel",
                "last_name": "Miguel",
                "username": "alysha.cruickshank81",
                "email": "tyrique.ankunding@example.com",
                "phone": "(426) 248-1729 x304",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 29,
                    "user_id": 29,
                    "image": "https:\/\/i.picsum.photos\/id\/1019\/600\/600.jpg",
                    "description": "Quod dolorum consequatur eos fuga molestiae neque.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 29,
            "user_id": 30,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 30,
                "first_name": "Elroy",
                "last_name": "Forrest",
                "username": "myrtle.koelpin79",
                "email": "zharvey@example.com",
                "phone": "586.478.5724",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 30,
                    "user_id": 30,
                    "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                    "description": "Nobis ullam aut in dolore eum laudantium.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 30,
            "user_id": 31,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 31,
                "first_name": "Shemar",
                "last_name": "Brooks",
                "username": "rafael.mueller39",
                "email": "groob@example.org",
                "phone": "758-930-4864 x1322",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 31,
                    "user_id": 31,
                    "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                    "description": "Nesciunt qui molestias quia nihil nemo.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 31,
            "user_id": 32,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 32,
                "first_name": "Desiree",
                "last_name": "Amy",
                "username": "hgoodwin24",
                "email": "ukoch@example.org",
                "phone": "586.306.7302",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 32,
                    "user_id": 32,
                    "image": "https:\/\/i.picsum.photos\/id\/650\/600\/600.jpg",
                    "description": "Dolorem nostrum culpa accusamus.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 32,
            "user_id": 33,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 33,
                "first_name": "Kyla",
                "last_name": "Alyson",
                "username": "derek.damore64",
                "email": "brooke.bauch@example.org",
                "phone": "1-776-732-2521",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 33,
                    "user_id": 33,
                    "image": "https:\/\/i.picsum.photos\/id\/650\/600\/600.jpg",
                    "description": "Quae quod enim similique cupiditate aliquam esse placeat.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 33,
            "user_id": 34,
            "business_id": 1,
            "status_id": 1,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 1,
                "name": "Approved"
            },
            "user": {
                "id": 34,
                "first_name": "Rusty",
                "last_name": "Neva",
                "username": "bosco.okey78",
                "email": "botsford.zane@example.org",
                "phone": "+1 (680) 398-7461",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 34,
                    "user_id": 34,
                    "image": "https:\/\/i.picsum.photos\/id\/145\/600\/600.jpg",
                    "description": "Amet consectetur laborum error quos.",
                    "created_at": "2020-05-22T00:32:01.000000Z",
                    "updated_at": "2020-05-22T00:32:01.000000Z"
                }
            }
        },
        {
            "id": 34,
            "user_id": 35,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 35,
                "first_name": "Ramona",
                "last_name": "Bernardo",
                "username": "woconner44",
                "email": "vtrantow@example.net",
                "phone": "875-276-5461 x861",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 35,
                    "user_id": 35,
                    "image": "https:\/\/i.picsum.photos\/id\/619\/600\/600.jpg",
                    "description": "Atque et nostrum eius est sed in.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 35,
            "user_id": 36,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 36,
                "first_name": "Susana",
                "last_name": "Kathryne",
                "username": "wschaefer52",
                "email": "samanta.harber@example.org",
                "phone": "(376) 390-0956 x333",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 36,
                    "user_id": 36,
                    "image": "https:\/\/i.picsum.photos\/id\/239\/600\/600.jpg",
                    "description": "Officia aut amet id dolorem quis voluptate.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 36,
            "user_id": 37,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 37,
                "first_name": "Jed",
                "last_name": "Keenan",
                "username": "breitenberg.bruce0",
                "email": "percival.berge@example.org",
                "phone": "503-288-1127",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 37,
                    "user_id": 37,
                    "image": "https:\/\/i.picsum.photos\/id\/586\/600\/600.jpg",
                    "description": "Fugiat non delectus totam minus voluptatum eos ut.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 37,
            "user_id": 38,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 38,
                "first_name": "Violette",
                "last_name": "Brandy",
                "username": "mireille7861",
                "email": "schoen.maria@example.org",
                "phone": "+1 (995) 552-5422",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 38,
                    "user_id": 38,
                    "image": "https:\/\/i.picsum.photos\/id\/547\/600\/600.jpg",
                    "description": "Sed molestiae id qui esse delectus.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 38,
            "user_id": 39,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 39,
                "first_name": "Frankie",
                "last_name": "Dante",
                "username": "mason.prosacco6",
                "email": "nheller@example.org",
                "phone": "957.410.5543",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 39,
                    "user_id": 39,
                    "image": "https:\/\/i.picsum.photos\/id\/338\/600\/600.jpg",
                    "description": "Quas corporis ipsa aut ut ad.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 39,
            "user_id": 40,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 40,
                "first_name": "Emilie",
                "last_name": "Hollie",
                "username": "considine.mabelle84",
                "email": "jweissnat@example.com",
                "phone": "454.951.4172",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 40,
                    "user_id": 40,
                    "image": "https:\/\/i.picsum.photos\/id\/835\/600\/600.jpg",
                    "description": "Eius quibusdam labore praesentium et ducimus fugit nam.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 40,
            "user_id": 41,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 41,
                "first_name": "Vergie",
                "last_name": "Cristina",
                "username": "kiana.hickle97",
                "email": "adrian.jakubowski@example.com",
                "phone": "1-594-955-9914 x48884",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 41,
                    "user_id": 41,
                    "image": "https:\/\/i.picsum.photos\/id\/338\/600\/600.jpg",
                    "description": "Quia voluptatem autem voluptates aliquam.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        },
        {
            "id": 41,
            "user_id": 42,
            "business_id": 1,
            "status_id": 2,
            "created_at": "2020-05-22T00:32:02.000000Z",
            "updated_at": "2020-05-22T00:32:02.000000Z",
            "status": {
                "id": 2,
                "name": "Pending"
            },
            "user": {
                "id": 42,
                "first_name": "Judge",
                "last_name": "Ubaldo",
                "username": "nratke44",
                "email": "umiller@example.net",
                "phone": "1-504-337-8252",
                "apn_token": null,
                "fcm_token": null,
                "email_verified_at": "2020-05-22T00:32:01.000000Z",
                "last_seen_at": null,
                "deleted_at": null,
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z",
                "isActive": false,
                "lastSeen": null,
                "profile": {
                    "id": 42,
                    "user_id": 42,
                    "image": "https:\/\/i.picsum.photos\/id\/521\/600\/600.jpg",
                    "description": "Aut et libero voluptatum.",
                    "created_at": "2020-05-22T00:32:02.000000Z",
                    "updated_at": "2020-05-22T00:32:02.000000Z"
                }
            }
        }
    ]
}

```



<a name="single"></a>
## Show Applicant

View a single applicant.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/applicant/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "View all applicants",
    "data": {
        "id": 3,
        "user_id": 4,
        "business_id": 1,
        "status_id": 2,
        "created_at": "2020-05-22T00:32:01.000000Z",
        "updated_at": "2020-05-22T00:32:01.000000Z",
        "status": {
            "id": 2,
            "name": "Pending"
        },
        "user": {
            "id": 4,
            "first_name": "Nia",
            "last_name": "Madge",
            "username": "applicant_one",
            "email": "alford78@example.com",
            "phone": "363-992-2699 x634",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-22T00:32:01.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-22T00:32:01.000000Z",
            "updated_at": "2020-05-22T00:32:01.000000Z",
            "isActive": false,
            "lastSeen": null,
            "profile": {
                "id": 4,
                "user_id": 4,
                "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                "description": "Nihil error ut omnis dolorum quaerat sunt enim quisquam.",
                "created_at": "2020-05-22T00:32:01.000000Z",
                "updated_at": "2020-05-22T00:32:01.000000Z"
            }
        }
    }
}

```



<a name="approve"></a>
## Approve Applicant

Approve an applicant so they can become a member of your marketplace
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/applicant/{id}/approve`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "This application has been approved",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "This user has already joined your business",
    "data": null
}

```



<a name="reject"></a>
## Reject Applicant

Reject an applicant from your business.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/applicant/{id}/reject`|`true`|




> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "This application has been rejected",
    "data": null
}

```

> {danger} Example Error Response

Code `400`

Content

```json
{
    "success": false,
    "message": "This user has already joined your business",
    "data": null
}

```



<a name="delete"></a>
## Delete Application

Remove an application from your business. This is irreversible.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`DELETE`|`/business/{unique_id}/applicant/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "This application has been removed",
    "data": null
}

```

