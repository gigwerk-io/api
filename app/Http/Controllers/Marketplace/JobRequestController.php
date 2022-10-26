<?php

namespace App\Http\Controllers\Marketplace;

use App\Events\Marketplace\CustomerHasRequested;
use Illuminate\Log\Logger;
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
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
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

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(
        Geolocation $geolocation,
        Dispatcher $eventDispatcher,
        MarketplaceJobRepository $marketplaceJobRepository,
        BusinessRepository $businessRepository,
        Base64Image $base64Image,
        FilesystemManager $filesystem,
        Logger $logger
    )
    {
        $this->geolocation = $geolocation;
        $this->eventDispatcher = $eventDispatcher;
        $this->base64Image = $base64Image;
        $this->marketplaceJobRepository = $marketplaceJobRepository;
        $this->businessRepository = $businessRepository;
        $this->filesystem = $filesystem;
        $this->logger = $logger;
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
     * @BodyParam(name="intensity", type="numeric", status="required", description="The intensity id of the job.", example="1")
     * @BodyParam(name="client_name", type="string", status="required", description="The first and last name of the client.", example="John Doe")
     * @BodyParam(name="price", type="numeric", status="required", description="The price of the job.", example="50.00")
     * @BodyParam(name="images", type="array", status="optional", description="Image for the job.")
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
        $data['client_name'] = $request->client_name;

//        dd($request->images);

        /** @var MarketplaceJob $marketplace */
        $marketplace = $this->marketplaceJobRepository->create($data);

        if ($request->has('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                try {
                    $fileExtension = $this->base64Image->getImageType($image);
                    $marketplace->addMediaFromBase64($image , ['image/png', 'image/jpg' , 'image/jpeg'])
                        ->usingFileName(str::random() . '.' . $fileExtension)
                        ->toMediaCollection();
                } catch (FileCannotBeAdded | FileDoesNotExist | FileIsTooBig | InvalidBase64Data $exception) {
                    $this->logger->error("Unable to upload your photo but the job was still posted!" . $exception->getMessage());
                }
            }
        }

        $location = $this->geolocation->geoLocate([$request->street_address, $request->city, $request->state, $request->zip]);
        $marketplace->location()->create([
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'lat' => $location->lat,
            'long' => $location->lng
        ]);

        $this->eventDispatcher->dispatch(new CustomerHasRequested($marketplace));

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
     * @BodyParam(name"intensity_id", type="numeric", status="optional", description="How hard the job is.", example="easy medium or hard")
     * @BodyParam(name"price", type="numeric", status="optional", description="How much it costs", example="$68.99")
     * @BodyParam(name="street_address", type="string", status="optional", description="The address of the job location", example="123 Main St NE")
     * @BodyParam(name="city", type="string", status="optional", description="The city of the job location.", example="Rochester")
     * @BodyParam(name="state", type="string", status="optional", description="The state of the job location.", example="MN")
     * @BodyParam(name="zip", type="string", status="optional", description="The zip code of the job location.", example="55901")
     * @ResponseExample(status=200, example="responses/marketplace/request/edit.job-200.json")
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

        if ($request->has('intensity_id')) {
            $marketplace->update(['intensity_id' => $request->intensity_id]);
        }

        if ($request->has('price')) {
            $marketplace->update(['price' => $request->price]);
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
