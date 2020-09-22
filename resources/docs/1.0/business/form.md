# Form

We provide businesses forms for when their applicants apply to their business.

---

- [Display Form](#display-form)


- [Update Form](#update-form)



<a name="display-form"></a>
## Display Form

Display the structure of a business form.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/business/{unique_id}/form`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Show business form",
    "data": {
        "formHeader": {
            "formTitle": "On-boarding Form",
            "formDescription": "This form is used to on-board new applicants to vet them for your business."
        },
        "formComponents": [
            {
                "component": "textarea",
                "options": {
                    "requireToggle": true,
                    "placeholder": "",
                    "label": "Why do you want to work with us?",
                    "name": "textarea-1600708230549",
                    "index": 0
                }
            },
            {
                "component": "radio",
                "options": {
                    "requireToggle": true,
                    "placeholder": "",
                    "label": "Are you able to lift up to 90 pounds on a frequent basis?",
                    "name": "radio-1600708653187",
                    "radioArr": [
                        {
                            "text": "yes",
                            "value": "yes"
                        },
                        {
                            "text": "no",
                            "value": "no"
                        }
                    ],
                    "index": 1
                }
            },
            {
                "component": "radio",
                "options": {
                    "requireToggle": true,
                    "placeholder": "",
                    "label": "Do you have a valid drivers license?",
                    "name": "radio-1600708457830",
                    "radioArr": [
                        {
                            "text": "yes",
                            "value": "yes"
                        },
                        {
                            "text": "no",
                            "value": "no"
                        }
                    ],
                    "index": 2
                }
            },
            {
                "component": "radio",
                "options": {
                    "requireToggle": true,
                    "placeholder": "",
                    "label": "Do you have your High school Diploma or G.E.D.",
                    "name": "radio-1600708735139",
                    "radioArr": [
                        {
                            "text": "yes",
                            "value": "yes"
                        },
                        {
                            "text": "no",
                            "value": "no"
                        }
                    ],
                    "index": 3
                }
            }
        ]
    }
}

```



<a name="update-form"></a>
## Update Form

Update a business form for their applicants.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`PATCH`|`/business/{unique_id}/form`|`true`|


### Body Params
|Name|Type|Status|Description|
|:-|:-|:-|:-|
|`formHeader`|`array`|`required`|`This is the meta data for your form.`|
|`formComponents`|`array`|`required`|`This is the array of form components.`|


> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Your business form has been updated.",
    "data": null
}

```


