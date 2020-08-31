<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class PluginController extends Controller
{

    /**
     * @Meta(name="Show plugins", description="Show a businesses third party ids" href"plugins")
     * @ResponseExample("status 200, example="responses/business/account/show.business.thirdpartyids-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $third_party_ids = [
            'facebook_pixel_id' => $business->facebook_pixel_id,
            'google_analytics_id' => $business->google_analytics_id,
        ];

        return ResponseFactory::success('Show third party ids' , $third_party_ids);
    }

    /**
     * @Meta(name="Update Third Party Id, description="THis updates a businesses third party ids." , href="plugins")
     * @BodyParam(name="facebook_pixel_id", "type="string", status="optional", description="Update the businesses facebook_pixel_id")
     * @BodyParam(name="google_analytics_id", "type="string", status="optional", description="Update the businesses google_analytics_id")
     * @ResponseExample("status 200, example="responses/business/account/update.business.thirdpartyid-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');
        if ($request->has('facebook_pixel_id')) {
            $business->update(['facebook_pixel_id' => $request->facebook_pixel_id]);
        }
        if ($request->has('google_analytics_id')) {
            $business->update(['google_analytics_id' => $request->google_analytics_id]);
        }
        return ResponseFactory::success('updated third party ids');
    }
}
