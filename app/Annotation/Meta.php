<?php


namespace App\Annotation;

/**
 * @Annotation
 */
class Meta
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description = '';

    /**
     * @var string
     */
    public $href;
}
