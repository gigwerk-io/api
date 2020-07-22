<?php

namespace App\Http\Controllers\Business;

use App\Notifications\User\ApplicationApprovedNotification;
use App\Notifications\User\ApplicationRejectedNotification;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Enum\User\ApplicationStatus;
use App\Enum\User\Role;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

/**
 * @Group(name="Applicant", description="Manage all of your businesses applications & applicants.")
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
        /** @var Business $business */
        $business = $request->get('business');

        $applicants = $business->applications()->with(['status', 'user.profile'])->get();

        return ResponseFactory::success('View all applicants', $applicants);
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
        /** @var Business $business */
        $business = $request->get('business');

        $applicant = $business->applications()->with(['status', 'user.profile'])->where('id', '=', $request->id)->first();
        $applicant->append('averageRating');

        if(is_null($applicant)) {
            return ResponseFactory::error(
                'Applicant not found',
                null,
                404
            );
        }

        return ResponseFactory::success('View all applicants', $applicant);
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

        $applicant = $business->applications()->with(['status', 'user.profile'])->where('id', '=', $request->id)->first();

        if(is_null($applicant)) {
            return ResponseFactory::error(
                'Applicant not found',
                null,
                404
            );
        }

        if ($business->users()->where('id', '=', $applicant->user->id)->exists()) {
            return ResponseFactory::error('This user has already joined your business');
        }


        $applicant->update(['status_id' => ApplicationStatus::APPROVED]);
        $applicant->user->notify(new ApplicationApprovedNotification($business));
        $business->users()->attach($applicant->user, ['role_id' => Role::VERIFIED_FREELANCER]);

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

        $applicant = $business->applications()->with(['status', 'user.profile'])->where('id', '=', $request->id)->first();

        if(is_null($applicant)) {
            return ResponseFactory::error(
                'Applicant not found',
                null,
                404
            );
        }

        if ($business->users()->where('id', '=', $applicant->user->id)->exists()) {
            return ResponseFactory::error('This user has already joined your business');
        }

        $applicant->update(['status_id' => ApplicationStatus::REJECTED]);
        // TODO: Send event

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
        /** @var Business $business */
        $business = $request->get('business');

        $applicant = $business->applications()->with(['status', 'user.profile'])->where('id', '=', $request->id)->first();

        if(is_null($applicant)) {
            return ResponseFactory::error(
                'Application not found',
                null,
                404
            );
        }

        $applicant->delete();

        return ResponseFactory::success('This application has been removed');
    }
}
