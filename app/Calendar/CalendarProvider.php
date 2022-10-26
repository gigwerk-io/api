<?php


namespace App\Calendar;


use App\Contracts\Calendar\Calendar;
use App\Enums\ApplicationEventType;
use App\Exceptions\MissingAccessTokenException;
use App\Models\ApplicationEvent;
use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use Google_Client as GoogleClient;
use Google_Service_Calendar as GoogleCalendar;
use Google_Service_Calendar_Event as GoogleEvent;

class CalendarProvider implements Calendar
{
    const CALENDAR_ID = 'primary';
    const TIMEZONE = 'America/Chicago';

    /**
     * @var GoogleClient
     */
    private $client;

    public function __construct(GoogleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Add an application event to google calendar.
     *
     * @param ApplicationEvent $applicationEvent
     * @return GoogleEvent
     * @throws MissingAccessTokenException
     */
    public function create(ApplicationEvent $applicationEvent)
    {
        $applicationEvent->load('application.business', 'application.user');
        /** @var Business $business */
        $business = $applicationEvent->application->business;
        /** @var User $user */
        $user = $applicationEvent->application->user;
        if (is_null($business->integration->google_access_token)) {
            throw new MissingAccessTokenException();
        }

        $this->client->setAccessToken($business->integration->google_access_token);
        $calendar = new GoogleCalendar($this->client);
        $event = new GoogleEvent([
            // Format title for event
            'summary' =>  sprintf(
                '%s: %s/%s',
                $applicationEvent->event_type->description,
                $user->name,
                $business->name
            ),
            'description' => $applicationEvent->notes,
            'start' => [
                'dateTime' => $applicationEvent->start_time->setTimezone($applicationEvent->timezone)->toRfc3339String()
            ],
            'end' => [
                'dateTime' => $applicationEvent->end_time->setTimezone($applicationEvent->timezone)->toRfc3339String()
            ],
            'attendees' => [
                ['email' => $business->owner->email],
                ['email' => $user->email]
            ],
            'reminders' => [
                'useDefault' => true,
            ]
        ]);
        return $calendar->events->insert(self::CALENDAR_ID, $event);
    }

    public function update(ApplicationEvent $applicationEvent)
    {

    }

    public function delete()
    {

    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}
