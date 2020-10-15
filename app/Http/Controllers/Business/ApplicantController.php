<?php

namespace App\Http\Controllers\Business;

use App\Calendar\CalendarProvider;
use App\Enums\ApplicationEventType;
use App\Enums\ApplicationStatus;
use App\Http\Middleware\ApplicationExists;
use App\Http\Requests\Business\CreateCalendarEventRequest;
use App\Models\Application;
use App\Models\ApplicationEvent;
use App\Notifications\User\ApplicationApprovedNotification;
use App\Notifications\User\ApplicationRejectedNotification;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Enum\User\Role;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

/**
 * @Group(name="Applicant", description="Manage all of your businesses applications & applicants.")
 *
 * We are setting applications via middleware to remove redundant code.
 * @see ApplicationExists
 */
class ApplicantController extends Controller
{
    /**
     * @var CalendarProvider
     */
    protected $calendar;

    public function __construct(CalendarProvider $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * @Meta(name="View Applicants", description="Show all of the applicants in a business.", href="all")
     * @ResponseExample(status=200, example="responses/business/applicant/all.applicants-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, ['status' => new EnumValue(ApplicationStatus::class, false)]);
        /** @var Business $business */
        $business = $request->get('business');

        $applications = $business->applications()->with(['user.profile'])->get();

        if ($request->has('status')) {
            $status = $request->status;
            $applications = $applications->filter(function($application) use ($status){
                return $application->status == $status;
            })->values();
        }

        return ResponseFactory::success('View all applicants', $applications);
    }

    /**
     * @Meta(name="Show Applicant", description="View a single applicant.", href="single")
     * @ResponseExample(status=200, example="responses/business/applicant/show.applicant-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Application $application */
        $application = $request->get('application');
        $application->load('events');

        return ResponseFactory::success('View all applicants', $application);
    }

    /**
     * @Meta(name="Schedule Calendar Event", description="Add a calendar event to Google.", href="calendar-event")
     * @BodyParam(name="event_type", type="numeric", status="required", description="This is the type of event.")
     * @BodyParam(name="start_time", type="string", status="required", description="The start time of the meeting.")
     * @BodyParam(name="end_time", type="string", status="required", description="The end time of the meeting.")
     * @BodyParam(name="timezone", type="string", status="required", description="The timezone of the creator.")
     * @BodyParam(name="notes", type="string", status="optional", description="Any additional notes added by creator.")
     * @ResponseExample(status=200, example="responses/business/applicant/schedule.applicant-200.json")
     *
     * @param CreateCalendarEventRequest $request
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\MissingAccessTokenException
     */
    public function schedule(CreateCalendarEventRequest $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        if (is_null($business->integration->google_access_token)) {
            return ResponseFactory::error('Missing Google Access Token.');
        }

        /** @var Application $application */
        $application = $request->get('application');

        // This prevents having multiple scheduled events. We might change it in the future if no longer useful.
        if ($application->events()->where('completed', '=', false)->count() > 0) {
            return ResponseFactory::error('You already have an event scheduled.');
        }

        switch ($request->event_type) {
            case ApplicationEventType::PHONE_SCREEN:
                $status = ApplicationStatus::PHONE_SCREENING;
                break;
            case ApplicationEventType::INTERVIEW:
                $status = ApplicationStatus::INTERVIEWING;
                break;
            case ApplicationEventType::ONBOARD:
                $status = ApplicationStatus::ONBOARDING;
                break;
            default:
                $status = $application->status;
                break;
        }

        $application->update(['status' => $status]);
        $data = $request->all();
        $data['start_time'] = Carbon::parse($data['start_time'], new \DateTimeZone($data['timezone']))
            ->setTimezone(config('app.timezone'))
            ->toDateTimeString();
        $data['end_time'] = Carbon::parse($data['end_time'], new \DateTimeZone($data['timezone']))
            ->setTimezone(config('app.timezone'))
            ->toDateTimeString();
        /** @var ApplicationEvent $event */
        $event = $application->events()->create($data);
        $calendarEvent = $this->calendar->create($event);
        $event->update(['google_calendar_id' => $calendarEvent->id]);

        return ResponseFactory::success('Your event has been scheduled.', $event->load('application.user.profile'));
    }

    /**
     * @Meta(name="Approve Applicant", description="Approve an applicant so they can become a member of your marketplace", href="approve")
     * @ResponseExample(status=200, example="responses/business/applicant/approve.applicant-200.json")
     * @ResponseExample(status=400, example="responses/business/applicant/approve.applicant-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        /** @var Application $application */
        $application = $request->get('application');

        if ($business->users()->where('id', '=', $application->user->id)->exists()) {
            return ResponseFactory::error('This user has already joined your business');
        }


        $application->update(['status_id' => ApplicationStatus::APPROVED]);
        $application->user->notify(new ApplicationApprovedNotification($business));
        $business->users()->attach($application->user, ['role_id' => Role::VERIFIED_FREELANCER]);
        $business->users()->update(['approved_at' => Carbon::now()->toDateString() ]);

        return ResponseFactory::success('This application has been approved');
    }


    /**
     * @Meta(name="Reject Applicant", description="Reject an applicant from your business.", href="reject")
     * @ResponseExample(status=200, example="responses/business/applicant/reject.applicant-200.json")
     * @ResponseExample(status=400, example="responses/business/applicant/reject.applicant-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        /** @var Application $application */
        $application = $request->get('application');

        if ($business->users()->where('id', '=', $application->user->id)->exists()) {
            return ResponseFactory::error('This user has already joined your business');
        }

        $application->update(['status' => ApplicationStatus::REJECTED]);
        $application->user->notify(new ApplicationRejectedNotification($business));

        return ResponseFactory::success('This application has been rejected');
    }


    /**
     * @Meta(name="Delete Application", description="Remove an application from your business. This is irreversible.", href="delete")
     * @ResponseExample(status=200, example="responses/business/applicant/delete.application-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        /** @var Application $application */
        $application = $request->get('application');

        $application->delete();

        return ResponseFactory::success('This application has been removed');
    }
}
