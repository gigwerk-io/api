<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Filesystem\Filesystem;

class ResponseExampleExists implements Rule
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Create a new rule instance.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->filesystem = app()->make('files');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $file = storage_path(str_replace('"', '', $value));
        return $this->filesystem->exists($file);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file :attribute was not found';
    }
}
