<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


/**
 * @method static static PHONE_SCREEN()
 * @method static static INTERVIEW()
 * @method static static ONBOARD()
 * @method static static OTHER()
 */
final class ApplicationEventType extends Enum
{
    const PHONE_SCREEN = 1;
    const INTERVIEW =   2;
    const ONBOARD = 3;
    const OTHER = 4;

    public static function parseDatabase($value)
    {
        return (integer)$value;
    }
}
