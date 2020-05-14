<?php

namespace App\Http\Controllers\Marketplace;

use App\Contracts\Geolocation\Geolocation;
use App\Contracts\Image\Base64Image;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
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
     * Submit a marketplace job
     *
     * @param SubmitJobRequest $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(SubmitJobRequest $request)
    {
        $user = $request->user();
        $business = $this->businessRepository->findWhere(['unique_id' => $request->business_id])->first();

        $data = $request->all();
        $data['business_id'] = $business->id;
        $data['customer_id'] = $user->id;
        $data['complete_before'] = Carbon::parse($request->complete_before)->toDateTimeString();

        if($request->has('image_one')){
            $image = base64_decode($request->image_one);
            $type = $this->base64Image->getImageType($request->image_one);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace', $image);
            $data['image_one'] = sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'marketplace', $name);

        }

        if($request->has('image_two')){
            $image = base64_decode($request->image_two);
            $type = $this->base64Image->getImageType($request->image_two);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace', $image);
            $data['image_two'] = sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'marketplace', $name);
        }

        if($request->has('image_three')){
            $image = base64_decode($request->image_three);
            $type = $this->base64Image->getImageType($request->image_three);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('marketplace', $image);
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

        $this->eventDispatcher->dispatch(null);

        return ResponseFactory::success(
            'Favr Successfully Posted!',
            ['id' => $marketplace->id],
            Response::HTTP_CREATED
        );
    }

    /**
     * Edit a marketplace job
     *
     * @param EditJobRequest $request
     * @return \Illuminate\Http\Response
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
        $location = $this->geo->geoLocate([$current->street_address, $current->city, $current->state, $current->zip]);
        $marketplace->location()->update(['lat' => $location->lat, 'long' => $location->lng]);

        return ResponseFactory::success(
            'Your job has been updated.'
        );
    }
}
