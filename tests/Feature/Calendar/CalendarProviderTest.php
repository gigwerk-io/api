<?php

namespace Tests\Feature\Calendar;

use App\Calendar\CalendarProvider;
use App\Contracts\Repositories\ApplicationRepository;
use App\Contracts\Repositories\BusinessRepository;
use App\Models\Application;
use App\Models\Business;
use Google_Service_Calendar_Event as GoogleEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\Factories\ApplicationEventFactory;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Calendar\CalendarProvider
 */
class CalendarProviderTest extends TestCase
{
    /**
     * @var CalendarProvider|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    protected $calendar;

    /**
     * @var Application
     */
    protected $application;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calendar = Mockery::mock(CalendarProvider::class);
        $this->application = $this->app->make(ApplicationRepository::class)->find(3);
    }

    /**
     * @covers ::create
     */
    public function test_create_calendar_event()
    {
        $event = $this->application->events()->create(ApplicationEventFactory::new()->make()->toArray());
        $this->calendar->shouldReceive('create')
            ->with($event)
            ->andReturn(GoogleEvent::class);
        $data = $this->calendar->create($event);
        $this->assertEquals(GoogleEvent::class, $data);
    }
}
