- ## Getting Started
  - [Overview](/&#123;&#123;route&#125;&#125;/&#123;&#123;version&#125;&#125;/overview)
  - [Enum Data](/&#123;&#123;route&#125;&#125;/&#123;&#123;version&#125;&#125;/enums)
  - [Models](/&#123;&#123;route&#125;&#125;/&#123;&#123;version&#125;&#125;/models)
- ## Endpoints
  @foreach($namespaces as $namespaceKey => $namespaceValue)
  - [{{$namespaceKey}}](#)
    @foreach($namespaceValue as $classKey => $classValue)
    - [{{$classValue->group->name}}](/&#123;&#123;route&#125;&#125;/&#123;&#123;version&#125;&#125;/{{strtolower($namespaceKey)}}/{{str_replace(' ', '-', strtolower($classValue->group->name))}})
    @endforeach

  @endforeach
