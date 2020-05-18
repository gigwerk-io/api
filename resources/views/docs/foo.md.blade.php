# {{$pageName}}

{{$pageDescription}}

---
@foreach($links as $link)
- [{{$link->name}}](#{{$link->href}})
@endforeach

@foreach($endpoints as $endpoint)
<a name="{{$endpoint->name}}"></a>

## {{$endpoint->name}}

{{$endpoint->description}}

### Endpoint
|Method|URI|Authentication|
|:-|:-|:-|
|`{{$endpoint->http_method}}`|`{{$endpoint->uri}}`|`{{$endpoint->requires_auth ? 'true' : 'false'}}`|

### Query Params
```text
None
```

### Body Params

```json
{{$endpoint->bodyParams->example}}
```

@foreach($endpoint->responses as $response)

@if($response->status >= 400)
> {danger} Example Error Response

@else
> {success} Example Success Response
@endif

Code `{{$response->status}}`

Content

```json
{{$response->example}}
```

@endforeach

<hr>
@endforeach
@if(is_array($endpoint->response))
@foreach($endpoint->response as $response)

@if($response->status >= 400)
> {danger} Example Error Response

@else
> {success} Example Success Response
@endif
Code `{{$response->status}}`

Content

```json
{{$response->example}}
```
@endforeach
@else
@if($response->status >= 400)
> {danger} Example Error Response

@else
> {success} Example Success Response
@endif
Code `{{$response->status}}`

Content

```json
{{$response->example}}
```
@endif
