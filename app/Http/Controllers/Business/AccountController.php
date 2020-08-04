<?php

namespace App\Http\Controllers\Business;

use Illuminate\Support\Facades\Storage;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Geolocation\Geolocation;
use App\Contracts\Image\Base64Image;
use App\Contracts\Stripe\Connect;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Business\UpdateLocationRequest;
use App\Http\Requests\Business\UpdateProfileRequest;
use App\Models\Business;
use App\Rules\Base64ImageRule;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @Group(name="Account", description="These routes belong are responsible for managing business accounts.")
 */
class AccountController extends Controller
{
    /**
     * @var Base64Image
     */
    private $base64Image;

    /**
     * @var FilesystemManager
     */
    private $filesystem;

    /**
     * @var Geolocation
     */
    private $geolocation;

    /**
     * @var Connect
     */
    private $connect;

    public function __construct(Base64Image $base64Image, FilesystemManager $filesystem, Geolocation $geolocation, Connect $connect)
    {
        $this->base64Image = $base64Image;
        $this->filesystem = $filesystem;
        $this->geolocation = $geolocation;
        $this->connect = $connect;
    }

    /**
     * @Meta(name="Show Account", description="Show the details of a business account.", href="show-account")
     * @ResponseExample(status=200, example="responses/business/account/show.account-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $business->load(['location', 'profile']);

        return ResponseFactory::success('Show business', $business);
    }

    /**
     * @Meta(name="Update Profile", description="This updates a businesses profile.", href="update-profile")
     * @BodyParam(name="name", type="string", status="optional", description="Update the name of the business")
     * @BodyParam(name="image", type="base64", status="optional", description="Update the profile image of the business.")
     * @BodyParam(name="cover", type="base64", status="optional", description="Update the cover image of the business.")
     * @BodyParam(name="short_description", type="string", status="optional", description="Update the headline of the business.")
     * @BodyParam(name="long_description", type="string", status="optional", description="Update the description of the business.")
     * @BodyParam(name="primary_color", type="string", status="optional", description="Update the primary color of your business app")
     * @BodyParam(name="secondary_color", type="string", status="optional", description="Update the secondary color of your business app")
     * @BodyParam(name="is_accepting_applications", type="boolean", status="optional", description="Update if your business is accepting applications or not")
     * @ResponseExample(status=200, example="responses/business/account/update.business.account-200.json")
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        if($request->has('name')) {
            $business->update(['name' => $request->name]);
        }

        if ($request->has('image')) {
            $type = $this->base64Image->getImageType($request->image);
            $name = Str::uuid() . "." . $type;
            $image = $business->addMediaFromBase64($request->image)
                ->setFileName($name)
                ->toMediaCollection('business', config('app.disk'));
            $business->profile()->update([
                'image' => $image->getFullUrl()
            ]);
        }

        if ($request->has('cover')) {
            $type = $this->base64Image->getImageType($request->cover);
            $name = Str::uuid() . "." . $type;
            $image = $business->addMediaFromBase64($request->cover)
                ->setFileName($name)
                ->toMediaCollection('business', config('app.disk'));
            $business->profile()->update([
                'image' => $image->getFullUrl()
            ]);
        }

        if ($request->has('short_description')) {
            $business->profile()->update(['short_description' => $request->short_description]);
        }

        if ($request->has('long_description')) {
            $business->profile()->update(['long_description' => $request->long_description]);
        }

        if ($request->has('primary_color')) {
            $business->profile()->update(['primary_color' => $request->primary_color]);
        }

        if ($request->has('secondary_color')) {
            $business->profile()->update(['secondary_color' => $request->secondary_color]);
        }

        if ($request->has('is_accepting_applications')) {
            $business->profile()->update(['is_accepting_applications' => $request->is_accepting_applications]);
        }

        return ResponseFactory::success(
            'Your business has been updated'
        );
    }

    /**
     * @Meta(name="Update Location", description="Update the location of the business.", href="update-location")
     * @BodyParam(name="street_address", type="string", status="optional", description="The address of the job location", example="123 Main St NE")
     * @BodyParam(name="city", type="string", status="optional", description="The city of the job location.", example="Rochester")
     * @BodyParam(name="state", type="string", status="optional", description="The state of the job location.", example="MN")
     * @BodyParam(name="zip", type="string", status="optional", description="The zip code of the job location.", example="55901")
     * @ResponseExample(status=200, example="responses/business/account/update.business.location-200.json")
     *
     * @param UpdateLocationRequest $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateLocation(UpdateLocationRequest $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        if ($request->has('street_address')) {
            $business->location()->update(['street_address' => $request->street_address]);
        }

        if ($request->has('city')) {
            $business->location()->update(['city' => $request->city]);
        }

        if ($request->has('state')) {
            $business->location()->update(['state' => $request->state]);
        }

        if ($request->has('zip')) {
            $business->location()->update(['zip' => $request->zip]);
        }

        $current = $business->location;
        $location = $this->geolocation->geoLocate([$current->street_address, $current->city, $current->state, $current->zip]);
        $business->location()->update(['lat' => $location->lat, 'long' => $location->lng]);

        return ResponseFactory::success('Your business location has been updated');
    }

    /**
     * @Meta(name="Stripe Login", description="Login or create Stripe Connect account for a business.", href="stripe-login")
     * @ResponseExample(status=200, example="responses/business/account/business.stripe.login-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function stripeLogin(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        if(is_null($business->stripe_connect_id)) {
            return ResponseFactory::success(
                'Stripe OAuth link created',
                ['url' => $this->connect->createStandardUrl($business->id)]
            );
        }

        return ResponseFactory::success(
            'Stripe OAuth link created',
            ['url' => $this->connect->createLoginLink($business->stripe_connect_id)]
        );
    }

    public function deactivate()
    {

    }

    // notification preferences: new application, updated job status, payout,
    // business status. Are you looking for more workers, at capacity, etc?
    // weekly summary opt in
    // deactivate org
    // transfer ownership
    // subscription tier
    // jobs that need attention
    // applications that need attention
    // missing steps as a business (banner)
}
