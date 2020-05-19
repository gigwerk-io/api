<?php


namespace App\Documentation;


use App\Annotation\Endpoint;
use App\Annotation\Group;
use App\Contracts\Documentation\Documentation;
use App\Contracts\Documentation\Extractor;
use App\Exceptions\Documentation\DocumentationException;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Minime\Annotations\Interfaces\ReaderInterface;
use ReflectionClass;

class DocumentationProvider implements Documentation
{
    const RESPONSE = 'ResponseExample';
    const BODY_PARAM = 'BodyParam';
    const QUERY_PARAM = 'QueryParam';
    const META = 'Meta';
    const GROUP = 'Group';

    /**
     * @var \Minime\Annotations\Interfaces\ReaderInterface
     */
    private $reader;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Extractor
     */
    private $extractor;

    /**
     * @var array
     */
    public $accepted = ['api'];


    public function __construct(ReaderInterface $reader, Router $router, Extractor $extractor)
    {
        $this->reader = $reader;
        $this->router = $router;
        $this->extractor = $extractor;
    }

    /**
     * Get routes that can be documented
     *
     * @return Collection
     */
    public function getFilteredRoutes()
    {
        $routes = $this->router->getRoutes()->getRoutes();
        $filtered = new Collection();
        foreach ($routes as $route) {
            if (!is_array($route->action['middleware'])) {
                continue;
            }

            if (!in_array('api', $route->action['middleware'])) {
                continue;
            }

            if (!is_string($route->action['uses'])) {
                continue;
            }

            // TODO: Add validation
            $uses = explode("@", (string)$route->action['uses']);

            // check if uri already has forward slash. If missing, this will add it.
            $uri = (substr($route->uri, 0, 1) === '/') ? $route->uri : DIRECTORY_SEPARATOR . $route->uri;
            $endpoint = new Endpoint();
            $endpoint->uri = $uri;
            $endpoint->httpMethod = $route->methods[0];
            $endpoint->requiresAuth = in_array('auth:sanctum', $route->middleware());
            $endpoint->class = $uses[0];
            $endpoint->classMethod = $uses[1];

            $filtered->add($endpoint);
        }

        return $filtered;
    }

    /**
     * Get docs for an endpoint.
     *
     * @param Endpoint $endpoint
     * @return Endpoint
     * @throws DocumentationException
     * @throws \ReflectionException
     */
    public function getMethodDocBlock(Endpoint $endpoint)
    {
        $annotations = $this->reader->getMethodAnnotations($endpoint->class, $endpoint->classMethod);
        $metaAnnotations = $annotations->get(self::META);
        $responseAnnotations = $annotations->get(self::RESPONSE);
        $bodyAnnotations = $annotations->get(self::BODY_PARAM);
        $queryAnnotations = null;

        if (!is_null($metaAnnotations)) {
            if (is_array($metaAnnotations)) {
                throw new DocumentationException(
                    sprintf(
                        'The method %s in %s can only have one @Meta annotation',
                        $endpoint->classMethod,
                        $endpoint->class
                    )
                );
            }

            $endpoint->meta = $this->extractor->meta($metaAnnotations);

        }


        if (!is_null($responseAnnotations)) {
            if (is_array($responseAnnotations)) {
                foreach ($responseAnnotations as $responseAnnotation) {
                    $endpoint->response[] = $this->extractor->response($responseAnnotation);
                }
            } else {
                $endpoint->response = $this->extractor->response($responseAnnotations);
            }
        }

        if (!is_null($bodyAnnotations)) {
            if (is_array($bodyAnnotations)) {
                foreach ($bodyAnnotations as $bodyAnnotation) {
                    $endpoint->bodyParams[] = $this->extractor->body($bodyAnnotation);
                }
            } else {
                $endpoint->bodyParams = $this->extractor->body($bodyAnnotations);
            }
        }

        return $endpoint;
    }

    /**
     * Get the group from a class.
     *
     * @param $key
     * @return Group
     * @throws \ReflectionException
     */
    public function getClassDocBlocks($key)
    {
        $classAnnotation = $this->reader->getClassAnnotations($key)->get(self::GROUP);
        if(!is_null($classAnnotation)) {
            return $this->extractor->group($classAnnotation);
        }else {
            return new Group();
        }
    }

    /**
     * Group endpoints by class and namespace.
     *
     * @param Collection $endpoints
     * @return Collection
     */
    public function groupEndpoints(Collection $endpoints)
    {
        // group by class
        $endpoints = $endpoints->groupBy(function (Endpoint $endpoint) {
            return $endpoint->class;
        });


        return $endpoints->groupBy(function ($item, $key){
            $r =  new ReflectionClass($key);
            $item->group = $this->getClassDocBlocks($key);
            return str_replace('App\Http\Controllers\\', '', $r->getNamespaceName());
        }, true);
    }
}
