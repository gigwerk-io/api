<?php

namespace App\Enums;

use BenSampo\Enum\Enum;




/**
 * @method static static NEW()
 * @method static static PHONE_SCREENING()
 * @method static static INTERVIEWING()
 * @method static static ONBOARDING()
 * @method static static APPROVED()
 * @method static static REJECTED()
 */
final class ApplicationStatus extends Enum
{
    const NEW = 1;
    const PHONE_SCREENING = 2;
    const INTERVIEWING = 3;
    const ONBOARDING = 4;
    const APPROVED = 5;
    const REJECTED = 6;
}
