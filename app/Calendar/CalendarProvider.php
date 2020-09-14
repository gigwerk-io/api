<?php


namespace App\Calendar;


use App\Contracts\Calendar\Calendar;
use Google_Client;

class CalendarProvider
{
    const CALENDAR_ID = 'primary';

    public static $client;

    public static function init($token)
    {
        self::$client = new Google_Client();
        self::$client->setAccessToken($token);
    }

    public static function create()
    {
        // TODO: Implement create() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}
