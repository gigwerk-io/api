<?php


namespace App\Contracts\Documentation;


use Illuminate\Support\Collection;

interface Writer
{
    /**
     * Create the documentation menu
     *
     * @param Collection $namespaces
     * @return bool|int
     */
    public function menu(Collection $namespaces);

    /**
     * Create the endpoint pages
     *
     * @param $endpoints
     * @param $name
     * @return bool|int
     */
    public function page($endpoints, $name);
}
