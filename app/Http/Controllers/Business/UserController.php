<?php

namespace App\Http\Controllers\Business;

use App\Annotation\Group;
use App\Annotation\Meta;
use App\Annotation\ResponseExample;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @Group(name="Users", description="This allows a business owner to manage the users of their marketplace.")
 */
class UserController extends Controller
{

    /**
     * @Meta(name="All Users", description="View all users that are apart of a business marketplace.", href="all-users")
     * @ResponseExample(status=200, example="responses/business/user/business.all.users-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $users = $business->users()->with('profile')->get();

        return ResponseFactory::success(
            'Show all users',
            $users
        );
    }

    /**
     * @Meta(name="Show User", description="View a single user.", href="show-user")
     * @ResponseExample(status=200, example="responses/business/user/business.show.user-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        /** @var User $user */
        $user = $business->users()->with('profile')->where('user_id', '=', $request->id)->first();

        // show payouts, role, proposals, and jobs.
        $user->load(['marketplaceProposals.marketplaceJob' => function ($query) use ($business) {
            $query->where('business_id', '=', $business->id);
        }, 'payouts.marketplaceJob' => function($query) use ($business) {
            $query->where('business_id', '=', $business->id);
        }, 'payments.marketplaceJob' => function($query) use ($business) {
            $query->where('business_id', '=', $business->id);
        }, 'marketplaceJobs' => function($query) use ($business) {
            $query->where('business_id', '=', $business->id);
        }]);


        if (is_null($user)) {
            return ResponseFactory::error(
                'User not found',
                null,
                404
            );
        }

        return ResponseFactory::success(
            'Show user',
            $user
        );
    }

    /**
     * @Meta(name="Update Role", description="Update a user's role within a business.", href="update-role")
     * @ResponseExample(status=200, example="responses/business/user/business.update.user-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'exists:user_roles,id'
        ]);

        /** @var Business $business */
        $business = $request->get('business');

        /** @var User $user */
        $user = $business->users()->where('user_id', '=', $request->id)->first();

        if (is_null($user)) {
            return ResponseFactory::error(
                'User not found',
                null,
                404
            );
        }

        $business->users()->updateExistingPivot($user, ['role_id' => $request->role_id]);

        return ResponseFactory::success('This users role has been updated.');
    }

    /**
     * @Meta(name="Remove User", description="This removes a user from your business marketplace. This action is irreverisble", href="remove-user")
     * @ResponseExample(status=200, example="responses/business/user/business.remove.user-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        /** @var User $user */
        $user = $business->users()->where('user_id', '=', $request->id)->first();


        if (is_null($user)) {
            return ResponseFactory::error(
                'User not found',
                null,
                404
            );
        }

        $business->users()->detach($user);

        return ResponseFactory::success('This user has been removed from your business.');
    }
}
