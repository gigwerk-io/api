<?php


namespace App\Contracts\Documentation;


interface Extractor
{
    public function response(string $response);

    public function meta(string $meta);

    public function group(string $group);

    public function body(string $body);

    public function query(string $query);
}
