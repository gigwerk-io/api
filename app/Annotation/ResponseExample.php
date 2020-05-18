<?php


namespace App\Annotation;

/**
 * @Annotation
 */
class ResponseExample
{
    /**
     * @var int
     */
    public $status = 200;

    /**
     * @var null|string
     */
    public $example = null;
}
