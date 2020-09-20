<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Carbon\Carbon;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use League\OAuth2\Client\Provider\Google;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Integrations", description="This is used for a business's third party integrations.")
 */
class IntegrationController extends Controller
{
    /**
     * @var Google
     */
    private $google;
    /**
     * @var RedisManager
     */
    private $redis;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;


    public function __construct(Google $google, BusinessRepository $businessRepository, RedisManager $redis)
    {
        $this->google = $google;
        $this->businessRepository = $businessRepository;
        $this->redis = $redis;
    }

    /**
     * @Meta(name="Show plugins", description="Show a businesses third party ids", href"plugins")
     * @ResponseExample(status=200, example="responses/business/integration/business.integrations-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        return ResponseFactory::success('Show third party ids' , $business->integration);
    }

    /**
     * @Meta(name="Save Google OAuth Token", description="This saves the token from the Google OAuth request.", href="save-token")
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function generateOAuthToken(Request $request)
    {
        $this->validate($request, [
            'code' => ['required', 'string'],
            'state' => ['required', 'string']
        ]);

        $data = $this->redis->get($request->state);

        if (is_null($data)) {
            return ResponseFactory::error('CSRF failure.');
        }

        $data = unserialize($data);

        $business = $this->businessRepository->findByUuid($data['unique_id']);

        if (is_null($business)) {
            return ResponseFactory::error('Business was not found.', null, 404);
        }

        $token = $this->google->getAccessToken('authorization_code', [
            'code' => $request->code,
        ]);

        $business->integration()->update([
            'google_access_token' => $token->getToken(),
            'google_refresh_token' => $token->getRefreshToken(),
            'google_expiration' => Carbon::parse($token->getExpires())
        ]);

        return redirect($data['url']);
    }

    /**
     * @Meta(name="Generate OAuth URL", description="This generates an authorization url to grant permissions w google", href="generate-url")
     * @ResponseExample(status=200, example="responses/business/integration/generate.google.url-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateOAuthUrl(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');
        $authUrl = $this->google->getAuthorizationUrl([
            'scope' => [Google_Service_Calendar::CALENDAR_EVENTS],
            'prompt' => 'consent'
        ]);

        $this->redis->set($this->google->getState(), serialize(['unique_id' => $business->unique_id, 'url' => $request->headers->get('referer')]));
        return ResponseFactory::success('Generated Google OAuth url', ['url' => $authUrl]);
    }

    /**
     * @Meta(name="Update Third Party Id", description="THis updates a businesses third party ids.", href="plugins")
     * @BodyParam(name="facebook_pixel_id", "type="string", status="optional", description="Update the businesses facebook_pixel_id")
     * @BodyParam(name="google_analytics_id", "type="string", status="optional", description="Update the businesses google_analytics_id")
     * @ResponseExample(status=200, example="responses/business/integration/update.business.integrations-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'facebook_pixel_id' => ['string'],
            'google_analytics_id' => ['string']
        ]);

        /** @var Business $business */
        $business = $request->get('business');
        if ($request->has('facebook_pixel_id')) {
            $business->integration()->update(['facebook_pixel_id' => $request->facebook_pixel_id]);
        }

        if ($request->has('google_analytics_id')) {
            $business->integration()->update(['google_analytics_id' => $request->google_analytics_id]);
        }

        return ResponseFactory::success('updated third party ids');
    }
}
