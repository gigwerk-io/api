<?php


namespace App\Enum\Billing;


class Plan
{
    const STANDARD = [
        'id' => 'price_1HPVUED2YnIDoaEISuW0WPeZ',
        'name' => 'Standard'
    ];

    const PRO = [
        'id' => 'price_1HPVVFD2YnIDoaEI6HF3KWGC',
        'name' => 'Pro'
    ];

    public static function toCollection()
    {
        return collect([
            self::STANDARD,
            self::PRO,
        ]);
    }
}
