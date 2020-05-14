<?php


namespace App\Contracts\Image;


use Intervention\Image\Image;

interface ImageResize
{
    /**
     * Resize the image
     *
     * @param string $data
     * @return Image
     */
    public function resizeProfileImage(string $data);

}
