<?php


namespace App\Contracts\Image;


interface Base64Image
{
    /**
     * Get type from base64 encoded image
     *
     * @param string $data
     * @return mixed
     */
    public function getImageType(string $data);

    /**
     * Check if image is png
     *
     * @param string $data
     * @return bool
     */
    public function isPng(string $data);

    /**
     * Check if image is jpg
     *
     * @param string $data
     * @return bool
     */
    public function isJpg(string $data);
}
