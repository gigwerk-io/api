<?php

namespace Tests;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseSetup;

    /**
     * Set to true if you want to save documentation
     *
     * @var bool
     */
    public $document = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setupDatabase();
    }

    /**
     * Save the response for documentation
     *
     * @param string $path
     * @param string $route
     * @param int $statusCode
     * @param string $jsonContent
     */
    protected function document(string $path, string $route, int $statusCode, ?string $jsonContent)
    {
        try {
            $filesystem = $this->app->make('filesystem');

            if($this->document){
                $fileName = sprintf('%s-%d.json', $route, $statusCode);
                $filePath = sprintf('responses/%s/%s', $path, $fileName);
                $filesystem->disk('local')->put($filePath, $jsonContent);
            }
        }catch (BindingResolutionException $exception) {
            print "Can't document routes.";
        }

    }
}
