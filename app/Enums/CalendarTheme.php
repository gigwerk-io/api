<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


/**
 * @method static static MARKETPLACE()
 * @method static static APPLICATION()
 * @method static static BIRTHDAY()
 */
final class CalendarTheme extends Enum
{
    const MARKETPLACE = 'yellow';
    const APPLICATION = 'blue';
    const BIRTHDAY = 'red';
}
