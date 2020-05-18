<?php

namespace App\Http\Controllers\User;

use App\Annotation\Group;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @Group(name="Notifications", description="These routes belong are responsible for managing user notifications.")
 */
class NotificationController extends Controller
{
    /**
     * Show single notification
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');

        $notification = $user->notifications()->where('id', '=', $id)
            ->where('data->business_id', '=', $business->id)
            ->first();

        if(is_null($notification)){
            return ResponseFactory::error(
                'Notification does not exist.',
                null,
                404
            );
        }

        $notification->markAsRead();


        return ResponseFactory::success(
            'Show notification',
            $notification
        );
    }

    /**
     * View unread notifications
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unread(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');

        $notifications = $user->unreadNotifications()->where('data->business_id', '=', $business->id)->get();

        return ResponseFactory::success(
            'Show new notifications',
            $notifications
        );
    }

    /**
     * View all notifications
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');

        $notifications = $user->notifications()->where('data->business_id', '=', $business->id)->get();

        return ResponseFactory::success(
            'Show new notifications',
            $notifications
        );
    }
}
