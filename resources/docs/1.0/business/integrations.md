# Integrations

This is used for a business&#039;s third party integrations.

---

- [Generate OAuth URL](#generate-url)


- [Save Google OAuth Token](#save-token)



<a name="generate-url"></a>
## Generate OAuth URL

This generates an authorization url to grant permissions w google
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`POST`|`/business/{unique_id}/google/oauth`|`true`|



> {success} Example Success Response
Code `200`

Content

```json
{
    "success": true,
    "message": "Generated Google OAuth url",
    "data": {
        "url": "https:\/\/accounts.google.com\/o\/oauth2\/v2\/auth?scope=openid%20email%20profile%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar.events&prompt=consent&state=eb46dc5b38e83e319cd55e6574ea5ccd&response_type=code&redirect_uri=https%3A%2F%2Fapi.gigwerk.test%2Fgoogle%2Foauth&client_id=45848104174-g83g8abd9d1u9e9bljnhcm9r7bupmuu7.apps.googleusercontent.com"
    }
}

```



<a name="save-token"></a>
## Save Google OAuth Token

This saves the token from the Google OAuth request.
### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`GET`|`/google/oauth`|`false`|





