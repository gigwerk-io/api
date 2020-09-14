<?php

namespace App\Http\Controllers\Business;

use App\Enums\ApplicationEventType;
use App\Enums\ApplicationStatus;
use App\Http\Middleware\ApplicationExists;
use App\Models\Application;
use App\Notifications\User\ApplicationApprovedNotification;
use App\Notifications\User\ApplicationRejectedNotification;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
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
     * @Meta(name="View Applicants", description="Show all of the applicants in a business.", href="all")
     * @ResponseExample(status=200, example="responses/business/applicant/all.applicants-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
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

    public function schedule(Request $request)
    {
        $this->validate($request, [
            'event_type' => ['required', new EnumValue(ApplicationEventType::class, false)],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
        ]);

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
        $data = $request->only(['event_type', 'start_time', 'end_time']);
        $data['start_time'] = Carbon::parse($data['start_time'])->toDateTimeString();
        $data['end_time'] = Carbon::parse($data['end_time'])->toDateTimeString();
        $event = $application->events()->create($data);
        // @todo: create an event in google calendar
        // Calendar::create($event)

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
