<?php

namespace App\Http\Controllers\Marketplace;

use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Geolocation\Geolocation;
use App\Contracts\Image\Base64Image;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Marketplace\EditJobRequest;
use App\Http\Requests\Marketplace\SubmitJobRequest;
use App\Models\MarketplaceJob;
use App\Rules\Base64ImageRule;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LVR\State\Abbr;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Group(name="Job Request", description="These routes are responsible for requesting and editing jobs.")
 */
class JobRequestController extends Controller
{
    /**
     * @var Geolocation
     */
    private $geolocation;

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var Base64Image
     */
    private $base64Image;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * @var FilesystemManager
     */
    private $filesystem;

    public function __construct(
        Geolocation $geolocation,
        Dispatcher $eventDispatcher,
        MarketplaceJobRepository $marketplaceJobRepository,
        BusinessRepository $businessRepository,
        Base64Image $base64Image,
        FilesystemManager $filesystem
    )
    {
        $this->geolocation = $geolocation;
        $this->eventDispatcher = $eventDispatcher;
        $this->base64Image = $base64Image;
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->businessRepository = $businessRepository;
        $this->filesystem = $filesystem;
    }

    /**
     * @Meta(name="Request Job", href="submit", description="Submit a job to the marketplace feed.")
     * @BodyParam(name="description", type="string", status="required", description="The description of the job.", example=" I need my lawn mowed.")
     * @BodyParam(name="complete_before", type="string", status="required", description="The deadline for the job.", example=" 03/11/2020 12:00:00")
     * @BodyParam(name="street_address", type="string", status="required", description="The address of the job location", example="123 Main St NE")
     * @BodyParam(name="city", type="string", status="required", description="The city of the job location.", example="Rochester")
     * @BodyParam(name="state", type="string", status="required", description="The state of the job location.", example="MN")
     * @BodyParam(name="zip", type="string", status="required", description="The zip code of the job location.", example="55901")
     * @BodyParam(name="category_id", type="numeric", status="required", description="The category id of the job.", example="1")
     * @BodyParam(name="business_id", type="string", status="required", description="The uuid of the business marketplace.", example="67327c61-b00d-4820-b764-94529a17bf45")
     * @BodyParam(name="price", type="numeric", status="required", description="The price of the job.", example="50.00")
     * @BodyParam(name="image_one", type="string", status="optional", description="Base64 encoded image of job.")
     * @BodyParam(name="image_two", type="string", status="optional", description="Base64 encoded image of job.")
     * @BodyParam(name="image_three", type="string", status="optional", description="Base64 encoded image of job.")
     * @ResponseExample(status=201, example="responses/marketplace/request/submit.job-201.json")
     *
     * @param SubmitJobRequest $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(SubmitJobRequest $request)
    {
        $user = $request->user();
        $business = $request->get('business');

        $data = $request->all();
        $data['business_id'] = $business->id;
        $data['customer_id'] = $user->id;
        $data['status_id'] = Status::REQUESTED;
        $data['complete_before'] = Carbon::parse($request->complete_before)->toDateTimeString();

        if($request->has('image_one')){
            $image = base64_decode($request->image_one);
            $type = $this->base64Image->getImageType($request->image_one);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace/' . $name, $image);
            $data['image_one'] = sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'marketplace', $name);

        }

        if($request->has('image_two')){
            $image = base64_decode($request->image_two);
            $type = $this->base64Image->getImageType($request->image_two);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace'. $name, $image);
            $data['image_two'] = sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'marketplace', $name);
        }

        if($request->has('image_three')){
            $image = base64_decode($request->image_three);
            $type = $this->base64Image->getImageType($request->image_three);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace'. $name, $image);
            $data['image_three'] = sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'marketplace', $name);
        }

        /** @var MarketplaceJob $marketplace */
        $marketplace = $this->marketplaceJobRepository->create($data);

        $location = $this->geolocation->geoLocate([$request->street_address, $request->city, $request->state, $request->zip]);
        $marketplace->location()->create([
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'lat' => $location->lat,
            'long' => $location->lng
        ]);

        // $this->eventDispatcher->dispatch(null);

        return ResponseFactory::success(
            'Job Successfully Posted!',
            $marketplace,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Meta(name="Edit Job", description="Edit a customers marketplace job.", href="edit-job")
     * @BodyParam(name="description", type="string", status="optional", description="The description of the job.", example=" I need my lawn mowed.")
     * @BodyParam(name="complete_before", type="string", status="optional", description="The deadline for the job.", example=" 03/11/2020 12:00:00")
     * @BodyParam(name="street_address", type="string", status="optional", description="The address of the job location", example="123 Main St NE")
     * @BodyParam(name="city", type="string", status="optional", description="The city of the job location.", example="Rochester")
     * @BodyParam(name="state", type="string", status="optional", description="The state of the job location.", example="MN")
     * @BodyParam(name="zip", type="string", status="optional", description="The zip code of the job location.", example="55901")
     * @ResponseExample(status=201, example="responses/marketplace/request/edit.job-200.json")
     *
     * @param EditJobRequest $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function edit(EditJobRequest $request)
    {
        /** @var MarketplaceJob $marketplace */
        $marketplace = $request->get('job');

        if ($marketplace->isComplete()) {
            return ResponseFactory::error(
                'You can not edit a completed job!'
            );
        }

        if ($request->has('description')) {
            $marketplace->update(['description' => $request->description]);
        }

        if ($request->has('complete_before')) {
            $marketplace->update(['complete_before' => Carbon::parse($request->date)->toDateTimeString()]);
        }

        if ($request->has('category_id')) {
            $marketplace->update(['category_id' => $request->category_id]);
        }

        if ($request->has('street_address')) {
            $marketplace->location()->update(['street_address' => $request->street_address]);
        }

        if ($request->has('city')) {
            $marketplace->location()->update(['city' => $request->city]);
        }

        if ($request->has('state')) {
            $marketplace->location()->update(['state' => $request->state]);
        }

        if ($request->has('zip')) {
            $marketplace->location()->update(['zip' => $request->zip]);
        }

        $current = $marketplace->location;
        $location = $this->geolocation->geoLocate([$current->street_address, $current->city, $current->state, $current->zip]);
        $marketplace->location()->update(['lat' => $location->lat, 'long' => $location->lng]);

        return ResponseFactory::success(
            'Your job has been updated.'
        );
    }
}
