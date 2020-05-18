<?php


namespace App\Documentation;


use App\Contracts\Documentation\StringBlade;
use App\Contracts\Documentation\Writer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class WriterProvider implements Writer
{
    /**
     * @var StringBlade
     */
    private $stringBlade;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * WriterProvider constructor.
     * @param StringBlade $stringBlade
     */
    public function __construct(StringBlade $stringBlade, Filesystem $filesystem)
    {
        $this->stringBlade = $stringBlade;
        $this->filesystem = $filesystem;
    }

    /**
     * Create the documentation menu
     *
     * @param Collection $namespaces
     * @return bool|int
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function menu(Collection $namespaces)
    {
        // todo: change to config
        $blade =  $this->filesystem->get(resource_path('views/docs/menu-skeleton.blade.php'));
        $markdown = $this->stringBlade->render($blade, ['namespaces' => $namespaces]);
        $markdown = $this->replaceBraces($markdown);
        $fileName = resource_path('docs/' . config('larecipe.versions.default') . DIRECTORY_SEPARATOR . 'index.md');

        return $this->filesystem->put($fileName, $markdown);
    }

    /**
     * Create the endpoint pages
     *
     * @param $endpoints
     * @param $name
     * @return bool|int
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function page($endpoints, $name)
    {
        $blade =  $this->filesystem->get(resource_path('views/docs/page-skeleton.blade.php'));
        $markdown = $this->stringBlade->render($blade, ['group' => $endpoints->group, 'endpoints' => $endpoints]);
        $path = resource_path('docs/' .config('larecipe.versions.default') . DIRECTORY_SEPARATOR . strtolower($name));
        $fileName = $path . DIRECTORY_SEPARATOR . str_replace(' ', '-', strtolower($endpoints->group->name)) .'.md';
        if(!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path);
        }

        return $this->filesystem->put($fileName, $markdown);
    }

    /**
     * Replace the escaped braces
     *
     * @param $markdown
     * @return string|string[]
     */
    private function replaceBraces($markdown)
    {
        $markdown = str_replace(array("&#123;"), '{', $markdown);
        return str_replace(array("&#125;"), '}', $markdown);
    }
}
