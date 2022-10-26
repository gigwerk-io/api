<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\ApplicationEventRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Enums\CalendarTheme;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\ApplicationEvent;
use App\Models\MarketplaceJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Calendar", description="Show a list of events on a business's calendar.")
 */
class CalendarController extends Controller
{
    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var ApplicationEventRepository
     */
    private $applicantEventRepository;


    public function __construct(MarketplaceJobRepository $marketplaceJobRepository, ApplicationEventRepository $applicantEventRepository)
    {
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->applicantEventRepository = $applicantEventRepository;
    }


    /**
     * @Meta(name="Show Events", description="Show a list of events for a business's calendar.", href="show-events")
     * @ResponseExample(status=200, example="responses/business/calendar/show.calendar-200.json")
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = collect();
        // get applicant event dates
        $marketplaceJobs = $this->marketplaceJobRepository->all();
        $jobDates = $marketplaceJobs->map(function (MarketplaceJob $marketplaceJob) {
            $event = (object)[];
            $event->date = Carbon::parse($marketplaceJob->complete_before)->unix();
            $event->title = $marketplaceJob->client_name . ' ' . 'Job';
            $event->theme = CalendarTheme::MARKETPLACE();
            return $event;
        });
        $dates->push($jobDates);


        $events = $this->applicantEventRepository->all();
        $applicationDates = $events->map(function (ApplicationEvent $applicationEvent) {
            $event = (object)[];
            $event->title = $applicationEvent->application->user->name . ' ' . $applicationEvent->event_type_description;
            $event->date = Carbon::parse($applicationEvent->start_time)->unix();
            $event->theme = CalendarTheme::APPLICATION();
            return $event;
        });
        $dates->push($applicationDates);

        return ResponseFactory::success('Show a list of events', $dates->first());
    }
}
