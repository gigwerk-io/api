<?php


namespace App\Contracts\Calendar;


use App\Models\ApplicationEvent;
use Google_Service_Calendar_Event as GoogleEvent;

interface Calendar
{
    /**
     * This creates an event on a users
     *
     * @param ApplicationEvent $applicationEvent
     * @return GoogleEvent
     */
    public function create(ApplicationEvent $applicationEvent);

    public function delete();

    public function update(ApplicationEvent $applicationEvent);

    public function read();
}
