<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;

/**
 * @Group(name="Notifications", description="These routes belong are responsible for managing business notifications.")
 */
class NotificationController extends Controller
{

    /**
     * @Meta(name="Show Notification", href="show-notification", description="Show a single business notification")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');
        $this->validate($request, ['id' => 'exists:notifications,id']);

        $notification = $business->notifications()->where('id', '=', $request->id)->first();

        $notification->markAsRead();

        return ResponseFactory::success(
            'Show notification',
            $notification
        );
    }

    /**
     * @Meta(name="Unread Notifications", href="unread-notifications", description="View unread business notifications.")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unread(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $notifications = $business->unreadNotifications()->get();
        return ResponseFactory::success(
            'Show new notifications',
            $notifications
        );
    }

    /**
     * @Meta(name="All Notifications", href="all-notifications", description="View all business notifications.")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $notifications = $business->notifications()->get();
        return ResponseFactory::success(
            'Show new notifications',
            $notifications
        );
    }
}
