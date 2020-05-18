<?php

namespace App\Console\Commands;

use App\Contracts\Documentation\Writer;
use App\Documentation\DocumentationProvider;
use App\Documentation\StringBladeProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GenerateDocumentationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate your API Documentation';

    /**
     * @var DocumentationProvider
     */
    protected $documentationProvider;

    /**
     * @var StringBladeProvider
     */
    protected $stringBladeProvider;


    /**
     * @var Writer
     */
    protected $writer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DocumentationProvider $documentationProvider, StringBladeProvider $stringBladeProvider, Writer $writer)
    {
        parent::__construct();
        $this->documentationProvider = $documentationProvider;
        $this->stringBladeProvider = $stringBladeProvider;
        $this->writer = $writer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = $this->documentationProvider->getFilteredRoutes();

        $endpoints = $this->documentationProvider->getMethodDocBlocks($routes);
        $namespaces = $this->documentationProvider->groupEndpoints($endpoints);

        $this->writer->menu($namespaces);

        $namespaces->map(function (Collection $namespace, string $name){
            $namespace->map(function (Collection $endpoints) use ($name){

                $this->writer->page($endpoints, $name);
            });
        });
    }

}
