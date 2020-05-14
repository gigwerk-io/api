<?php


namespace App\Image;


use App\Contracts\Image\ImageResize;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ImageResizeProvider implements ImageResize
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * Resize the image
     *
     * @param string $data
     * @return Image
     */
    public function resizeProfileImage(string $data)
    {
        return $this->imageManager
            ->make($data)
            ->resize(256, 256)
            ->save(storage_path('app/images/' . Str::random()));
    }
}
