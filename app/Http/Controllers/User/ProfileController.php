<?php

namespace App\Http\Controllers\User;

use App\Contracts\Image\Base64Image;
use App\Contracts\Image\ImageResize;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\Business;
use App\Models\MarketplaceJob;
use App\Models\MarketplaceProposal;
use App\Models\User;
use App\Rules\Base64ImageRule;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Profile", description="Manage user profile routes and actions.")
 */
class ProfileController extends Controller
{
    /**
     * @var Base64Image
     */
    private $base64Image;

    /**
     * @var ImageResize
     */
    private $imageResize;

    /**
     * @var FilesystemManager
     */
    private $filesystem;


    public function __construct(Base64Image $base64Image, ImageResize $imageResize, FilesystemManager $filesystem)
    {
        $this->base64Image = $base64Image;
        $this->imageResize = $imageResize;
        $this->filesystem = $filesystem;
    }


    /**
     * @Meta(name="View Profile", href="view-profile", description="View a user's profile within a business app.")
     * @ResponseExample(status=200, example="responses/user/profile/show.user.profile-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');
        // Basic details
        /** @var User $user */
        $relations = [
            'marketplaceJobs.proposals.user.profile',
            'profile',
            'marketplaceProposals.marketplaceJob.customer.profile',
            'marketplaceJobs.customer.profile'
        ];
        $user = $business->users()->with($relations)->where('id', '=', $request->user_id)->first();

        $user->marketplaceJobs = $user->marketplaceJobs->filter(function (MarketplaceJob $marketplaceJob) use ($business){
            return $marketplaceJob->business_id === $business->id;
        });

        $user->marketplaceProposals = $user->marketplaceProposals->filter(function (MarketplaceProposal $marketplaceProposal) use ($business){
            return $marketplaceProposal->marketplaceJob->business_id  === $business->id;
        });



        if (is_null($user)) {
            return ResponseFactory::error(
                'User not found',
                null,
                404
            );
        }

        return ResponseFactory::success('Show user profile', $user);
    }

    /**
     * @Meta(name="Edit Profile", href="edit-profile", description="Edit a user's Gigwerk profile.")
     * @ResponseExample(status=200, example="responses/user/profile/update.user.profile-200.json")
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = $request->user();
        $this->validate($request, [
            'image' => new Base64ImageRule(),
            'email' => 'email',
            'first_name' => 'string',
            'last_name' => 'string',
            'phone' => 'string'
        ]);

        if ($request->has('description')) {
            $user->profile()->update([
                'description' => $request->description
            ]);
        }

        if ($request->has('image')) {
            $image = $this->imageResize->resizeProfileImage($request->image)->getEncoded();
            $type = $this->base64Image->getImageType($request->image);
            $name = Str::uuid() . "." . $type;
            $this->filesystem->disk('s3')->put('profile'. $name, $image);
            $user->profile()->update([
                'image' => sprintf("%s/%s/%s", config('filesystem.disks.s3.url'), 'profile', $name)
            ]);
        }

        if ($request->has('email')) {
            $user->update(['email' => $request->email]);
        }

        if ($request->has('phone')) {
            $request->phone = str_replace('+1', '', $request->phone);
            $user->update(['phone' => "+1".preg_replace('/\D+/', '', $request->phone)]);
        }

        if ($request->has('first_name')) {
            $user->update(['first_name' => $request->first_name]);
        }

        if ($request->has('last_name')) {
            $user->update(['last_name' => $request->last_name]);
        }

        return ResponseFactory::success(
            'Profile has been updated'
        );
    }
}
