# General



---

- [All Users](#all-users)


- [Show User](#show-user)



<a name="all-users"></a>
## All Users

View all users that are apart of a business marketplace.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/users`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show all users",
    "data": [
        {
            "id": 1,
            "first_name": "Twila",
            "last_name": "Candida",
            "username": "admin_one",
            "email": "zackery25@example.org",
            "phone": "398.585.3970",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:09.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:09.000000Z",
            "updated_at": "2020-05-21T05:41:09.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 1,
                "role_id": 1
            },
            "profile": {
                "id": 1,
                "user_id": 1,
                "image": "https:\/\/i.picsum.photos\/id\/548\/600\/600.jpg",
                "description": "Voluptatum nostrum sint laborum exercitationem ut voluptatem sit.",
                "created_at": "2020-05-21T05:41:09.000000Z",
                "updated_at": "2020-05-21T05:41:09.000000Z"
            }
        },
        {
            "id": 2,
            "first_name": "Augustine",
            "last_name": "Maryam",
            "username": "worker_one",
            "email": "florence43@example.net",
            "phone": "(347) 356-0729",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:09.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:09.000000Z",
            "updated_at": "2020-05-21T05:41:09.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 2,
                "role_id": 1
            },
            "profile": {
                "id": 2,
                "user_id": 2,
                "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                "description": "Vel quis voluptas ut rerum quod.",
                "created_at": "2020-05-21T05:41:09.000000Z",
                "updated_at": "2020-05-21T05:41:09.000000Z"
            }
        },
        {
            "id": 3,
            "first_name": "Marianna",
            "last_name": "Yvette",
            "username": "pending_one",
            "email": "runte.elaina@example.com",
            "phone": "(431) 805-7793 x1066",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:09.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:09.000000Z",
            "updated_at": "2020-05-21T05:41:09.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 3,
                "role_id": 2
            },
            "profile": {
                "id": 3,
                "user_id": 3,
                "image": "https:\/\/i.picsum.photos\/id\/680\/600\/600.jpg",
                "description": "Vero molestiae distinctio occaecati.",
                "created_at": "2020-05-21T05:41:09.000000Z",
                "updated_at": "2020-05-21T05:41:09.000000Z"
            }
        },
        {
            "id": 9,
            "first_name": "Jessica",
            "last_name": "Harmon",
            "username": "multi_user",
            "email": "durgan.ellis@example.com",
            "phone": "(815) 501-1924",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:09.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:09.000000Z",
            "updated_at": "2020-05-21T05:41:09.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 9,
                "role_id": 1
            },
            "profile": {
                "id": 9,
                "user_id": 9,
                "image": "https:\/\/i.picsum.photos\/id\/650\/600\/600.jpg",
                "description": "Qui libero fuga quaerat.",
                "created_at": "2020-05-21T05:41:09.000000Z",
                "updated_at": "2020-05-21T05:41:09.000000Z"
            }
        },
        {
            "id": 10,
            "first_name": "Nathan",
            "last_name": "Douglas",
            "username": "ernesto.mcclure8",
            "email": "clifton.jacobson@example.com",
            "phone": "+1.439.850.0454",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 10,
                "role_id": 1
            },
            "profile": {
                "id": 10,
                "user_id": 10,
                "image": "https:\/\/i.picsum.photos\/id\/338\/600\/600.jpg",
                "description": "Sunt fugiat ea eius dolor voluptatum ea.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 11,
            "first_name": "Angus",
            "last_name": "Felipe",
            "username": "kaylin2050",
            "email": "imogene.rempel@example.org",
            "phone": "845-378-2140",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 11,
                "role_id": 1
            },
            "profile": {
                "id": 11,
                "user_id": 11,
                "image": "https:\/\/i.picsum.photos\/id\/386\/600\/600.jpg",
                "description": "Eius eius corrupti rerum laudantium atque.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 12,
            "first_name": "Darrion",
            "last_name": "Creola",
            "username": "isadore.jenkins51",
            "email": "kshlerin.tavares@example.com",
            "phone": "+13472006162",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 12,
                "role_id": 1
            },
            "profile": {
                "id": 12,
                "user_id": 12,
                "image": "https:\/\/i.picsum.photos\/id\/680\/600\/600.jpg",
                "description": "Iure tempore voluptatem quis labore eos voluptates.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 13,
            "first_name": "Kole",
            "last_name": "Lilyan",
            "username": "skessler93",
            "email": "spencer.justus@example.net",
            "phone": "202-680-1441",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 13,
                "role_id": 1
            },
            "profile": {
                "id": 13,
                "user_id": 13,
                "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
                "description": "Sed vitae distinctio aut et sequi.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 14,
            "first_name": "Thelma",
            "last_name": "Deanna",
            "username": "remington829",
            "email": "corkery.kaleb@example.net",
            "phone": "+18635808813",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 14,
                "role_id": 1
            },
            "profile": {
                "id": 14,
                "user_id": 14,
                "image": "https:\/\/i.picsum.photos\/id\/680\/600\/600.jpg",
                "description": "Reprehenderit vitae enim sit ratione qui enim molestias.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 15,
            "first_name": "Marietta",
            "last_name": "Dorris",
            "username": "ziemann.darwin35",
            "email": "mayer.chaya@example.net",
            "phone": "+1.825.372.6513",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 15,
                "role_id": 1
            },
            "profile": {
                "id": 15,
                "user_id": 15,
                "image": "https:\/\/i.picsum.photos\/id\/1019\/600\/600.jpg",
                "description": "Qui aliquam suscipit quibusdam nemo quia optio in itaque.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 16,
            "first_name": "Carmella",
            "last_name": "Eleazar",
            "username": "ygulgowski73",
            "email": "zbeahan@example.net",
            "phone": "(389) 758-2381",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 16,
                "role_id": 1
            },
            "profile": {
                "id": 16,
                "user_id": 16,
                "image": "https:\/\/i.picsum.photos\/id\/310\/600\/600.jpg",
                "description": "Officia praesentium voluptatem voluptates.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 17,
            "first_name": "Morgan",
            "last_name": "Maryjane",
            "username": "asha.farrell39",
            "email": "meggie98@example.net",
            "phone": "+1.219.606.1681",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 17,
                "role_id": 1
            },
            "profile": {
                "id": 17,
                "user_id": 17,
                "image": "https:\/\/i.picsum.photos\/id\/2\/600\/600.jpg",
                "description": "Eos et velit tenetur nesciunt.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 18,
            "first_name": "Yasmin",
            "last_name": "Agustina",
            "username": "angus.strosin58",
            "email": "weber.reta@example.net",
            "phone": "+1-684-646-2658",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 18,
                "role_id": 1
            },
            "profile": {
                "id": 18,
                "user_id": 18,
                "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                "description": "Modi similique cum quidem earum.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 19,
            "first_name": "Rico",
            "last_name": "Arturo",
            "username": "kennedi.mraz74",
            "email": "jaycee24@example.com",
            "phone": "+1 (747) 722-0298",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 19,
                "role_id": 1
            },
            "profile": {
                "id": 19,
                "user_id": 19,
                "image": "https:\/\/i.picsum.photos\/id\/586\/600\/600.jpg",
                "description": "Natus quis praesentium laboriosam minus quaerat delectus.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 20,
            "first_name": "Dayne",
            "last_name": "Jeanne",
            "username": "sonia.smitham49",
            "email": "giles.bashirian@example.org",
            "phone": "+1 (941) 431-2241",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 20,
                "role_id": 1
            },
            "profile": {
                "id": 20,
                "user_id": 20,
                "image": "https:\/\/i.picsum.photos\/id\/338\/600\/600.jpg",
                "description": "Deserunt qui sequi ut est porro sapiente.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 21,
            "first_name": "Nels",
            "last_name": "Stanton",
            "username": "bashirian.edna33",
            "email": "ivory.jast@example.org",
            "phone": "+1-807-462-2825",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 21,
                "role_id": 1
            },
            "profile": {
                "id": 21,
                "user_id": 21,
                "image": "https:\/\/i.picsum.photos\/id\/386\/600\/600.jpg",
                "description": "Velit nihil accusantium enim distinctio maxime placeat fugit.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 22,
            "first_name": "Cleora",
            "last_name": "Kiarra",
            "username": "ikeeling84",
            "email": "rhiannon84@example.com",
            "phone": "387.451.6131",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 22,
                "role_id": 1
            },
            "profile": {
                "id": 22,
                "user_id": 22,
                "image": "https:\/\/i.picsum.photos\/id\/548\/600\/600.jpg",
                "description": "Porro tempore consectetur provident saepe neque.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 23,
            "first_name": "Lonny",
            "last_name": "Kaylee",
            "username": "shanon8499",
            "email": "luna03@example.net",
            "phone": "(406) 453-5324 x32891",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 23,
                "role_id": 1
            },
            "profile": {
                "id": 23,
                "user_id": 23,
                "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                "description": "Quidem illum unde voluptatem aut.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 24,
            "first_name": "Esther",
            "last_name": "Sanford",
            "username": "gaylord.kiara15",
            "email": "leuschke.rhea@example.org",
            "phone": "917.805.5863 x7236",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 24,
                "role_id": 1
            },
            "profile": {
                "id": 24,
                "user_id": 24,
                "image": "https:\/\/i.picsum.photos\/id\/586\/600\/600.jpg",
                "description": "Accusamus nobis et et accusantium.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 25,
            "first_name": "Charlie",
            "last_name": "Tara",
            "username": "torn70",
            "email": "alexis.kuhlman@example.net",
            "phone": "+1-970-443-8097",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 25,
                "role_id": 2
            },
            "profile": {
                "id": 25,
                "user_id": 25,
                "image": "https:\/\/i.picsum.photos\/id\/145\/600\/600.jpg",
                "description": "Deserunt est architecto asperiores autem.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 26,
            "first_name": "May",
            "last_name": "Brando",
            "username": "atoy67",
            "email": "mylene.stamm@example.com",
            "phone": "1-502-767-4104 x23492",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 26,
                "role_id": 2
            },
            "profile": {
                "id": 26,
                "user_id": 26,
                "image": "https:\/\/i.picsum.photos\/id\/1019\/600\/600.jpg",
                "description": "Laudantium sit odit quas non.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 27,
            "first_name": "Kayli",
            "last_name": "Maryjane",
            "username": "randy.cole1",
            "email": "norval27@example.net",
            "phone": "913.968.6385 x038",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 27,
                "role_id": 2
            },
            "profile": {
                "id": 27,
                "user_id": 27,
                "image": "https:\/\/i.picsum.photos\/id\/835\/600\/600.jpg",
                "description": "Et tenetur nihil quia est.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 28,
            "first_name": "Pinkie",
            "last_name": "Ardella",
            "username": "fdubuque13",
            "email": "eliseo55@example.net",
            "phone": "+1-769-505-5005",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 28,
                "role_id": 2
            },
            "profile": {
                "id": 28,
                "user_id": 28,
                "image": "https:\/\/i.picsum.photos\/id\/668\/600\/600.jpg",
                "description": "Omnis modi delectus eaque et est.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 29,
            "first_name": "Mona",
            "last_name": "Austin",
            "username": "wromaguera92",
            "email": "eichmann.ronaldo@example.com",
            "phone": "+1 (407) 964-5684",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 29,
                "role_id": 2
            },
            "profile": {
                "id": 29,
                "user_id": 29,
                "image": "https:\/\/i.picsum.photos\/id\/680\/600\/600.jpg",
                "description": "Itaque non harum sequi id laborum.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 30,
            "first_name": "Ole",
            "last_name": "Kassandra",
            "username": "okrajcik12",
            "email": "miles.armstrong@example.net",
            "phone": "278-704-7406 x042",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 30,
                "role_id": 2
            },
            "profile": {
                "id": 30,
                "user_id": 30,
                "image": "https:\/\/i.picsum.photos\/id\/401\/600\/600.jpg",
                "description": "Soluta aut qui aperiam recusandae quibusdam nihil et sed.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 31,
            "first_name": "Fannie",
            "last_name": "Eloisa",
            "username": "stamm.sean21",
            "email": "kruecker@example.org",
            "phone": "1-393-209-1408 x56926",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 31,
                "role_id": 2
            },
            "profile": {
                "id": 31,
                "user_id": 31,
                "image": "https:\/\/i.picsum.photos\/id\/619\/600\/600.jpg",
                "description": "Quod impedit ut eum qui.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 32,
            "first_name": "Carmine",
            "last_name": "Elza",
            "username": "zjones68",
            "email": "lilly01@example.org",
            "phone": "1-526-746-9361",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 32,
                "role_id": 2
            },
            "profile": {
                "id": 32,
                "user_id": 32,
                "image": "https:\/\/i.picsum.photos\/id\/619\/600\/600.jpg",
                "description": "Impedit occaecati molestias rem qui ea delectus.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 33,
            "first_name": "Birdie",
            "last_name": "Ken",
            "username": "pauline0364",
            "email": "vzboncak@example.org",
            "phone": "821.971.1048 x4446",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 33,
                "role_id": 2
            },
            "profile": {
                "id": 33,
                "user_id": 33,
                "image": "https:\/\/i.picsum.photos\/id\/558\/600\/600.jpg",
                "description": "Fuga voluptate iure repellendus ea dolorem eum hic dignissimos.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        },
        {
            "id": 34,
            "first_name": "Jaunita",
            "last_name": "Fabiola",
            "username": "hamill.leslie7",
            "email": "owolff@example.net",
            "phone": "464-469-3399",
            "apn_token": null,
            "fcm_token": null,
            "email_verified_at": "2020-05-21T05:41:10.000000Z",
            "last_seen_at": null,
            "deleted_at": null,
            "created_at": "2020-05-21T05:41:10.000000Z",
            "updated_at": "2020-05-21T05:41:10.000000Z",
            "isActive": false,
            "pivot": {
                "business_id": 1,
                "user_id": 34,
                "role_id": 2
            },
            "profile": {
                "id": 34,
                "user_id": 34,
                "image": "https:\/\/i.picsum.photos\/id\/58\/600\/600.jpg",
                "description": "Voluptatem non odio est.",
                "created_at": "2020-05-21T05:41:10.000000Z",
                "updated_at": "2020-05-21T05:41:10.000000Z"
            }
        }
    ]
}

```



<a name="show-user"></a>
## Show User

View a single user.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/user/{id}`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show user",
    "data": {
        "id": 2,
        "first_name": "Augustine",
        "last_name": "Maryam",
        "username": "worker_one",
        "email": "florence43@example.net",
        "phone": "(347) 356-0729",
        "apn_token": null,
        "fcm_token": null,
        "email_verified_at": "2020-05-21T05:41:09.000000Z",
        "last_seen_at": null,
        "deleted_at": null,
        "created_at": "2020-05-21T05:41:09.000000Z",
        "updated_at": "2020-05-21T05:41:09.000000Z",
        "isActive": false,
        "pivot": {
            "business_id": 1,
            "user_id": 2,
            "role_id": 1
        },
        "profile": {
            "id": 2,
            "user_id": 2,
            "image": "https:\/\/i.picsum.photos\/id\/691\/600\/600.jpg",
            "description": "Vel quis voluptas ut rerum quod.",
            "created_at": "2020-05-21T05:41:09.000000Z",
            "updated_at": "2020-05-21T05:41:09.000000Z"
        }
    }
}

```


