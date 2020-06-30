<?php


namespace App\Enum\Billing;


class Plan
{
    const BASIC = [
        'id' => 'price_1GxacvD2YnIDoaEIvDuZUD5W',
        'name' => 'Basic Plan'
    ];
    const PRO = [
        'id' => 'price_1GxadxD2YnIDoaEI8iOxwkI9',
        'name' => 'Pro Plan'
    ];

    const ENTERPRISE = [
        'id' => 'price_1GyqM4D2YnIDoaEIXvGKWdiJ',
        'name' => 'Enterprise Plan'
    ];

    public static function toCollection()
    {
        return collect([
            self::BASIC,
            self::PRO,
            self::ENTERPRISE,
        ]);
    }
}
