<?php


namespace App\Image;


use App\Contracts\Image\Base64Image;

class Base64ImageProvider implements Base64Image
{
    /**
     * Get type from base64 encoded image
     *
     * @param string $data
     * @return mixed
     */
    public function getImageType(string $data)
    {
        $img = explode(',', $data);
        $ini =substr($img[0], 11);
        $type = explode(';', $ini);
        return $type[0];
    }

    /**
     * Check if image is png
     *
     * @param string $data
     * @return bool
     */
    public function isPng(string $data)
    {
        return ($this->getImageType($data) == 'png');
    }

    /**
     * Check if image is jpg
     *
     * @param string $data
     * @return bool
     */
    public function isJpg(string $data)
    {
        return ($this->getImageType($data) == 'jpg');
    }
}
