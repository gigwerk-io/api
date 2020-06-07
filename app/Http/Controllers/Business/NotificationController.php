<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;

/**
 * @Group(name="Notifications", description="These routes belong are responsible for managing business notifications.")
 */
class NotificationController extends Controller
{

    public function index()
    {

    }

    /**
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


}
