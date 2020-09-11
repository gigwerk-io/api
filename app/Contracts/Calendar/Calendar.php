<?php


namespace App\Contracts\Calendar;


interface Calendar
{
    public static function create();

    public function delete();

    public function update();

    public function read();
}
