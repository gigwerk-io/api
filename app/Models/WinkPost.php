<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class WinkPost.
 *
 * @package namespace App\Models;
 */
class WinkPost extends \Wink\WinkPost implements Transformable
{
    use TransformableTrait;

}
