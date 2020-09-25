<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Application.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property int $business_id
 * @property \App\Enums\ApplicationStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ApplicationEvent[] $events
 * @property-read int|null $events_count
 * @property-read mixed $average_rating
 * @property-read mixed $scheduled
 * @property-read mixed $status_description
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereUserId($value)
 */
	class Application extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class ApplicationEvent.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $application_id
 * @property \App\Enums\ApplicationEventType $event_type
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property string $timezone
 * @property string|null $notes
 * @property bool $completed
 * @property string|null $google_calendar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Application $application
 * @property-read string $event_type_description
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationEvent whereUpdatedAt($value)
 */
	class ApplicationEvent extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class business.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $owner_id
 * @property string $unique_id
 * @property string $name
 * @property bool $is_accepting_applications
 * @property bool $is_approved
 * @property string $subdomain_prefix
 * @property string|null $stripe_connect_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\BusinessApp|null $businessApp
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deployment[] $deployments
 * @property-read int|null $deployments_count
 * @property-read \App\Models\BusinessIntegration|null $integration
 * @property-read \App\Models\BusinessLocation|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceJob[] $marketplaceJobs
 * @property-read int|null $marketplace_jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\BusinessProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Business newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Business query()
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereIsAcceptingApplications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereStripeConnectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereSubdomainPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereUpdatedAt($value)
 */
	class Business extends \Eloquent implements \Prettus\Repository\Contracts\Transformable, \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class BusinessApp.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $business_id
 * @property string $domain
 * @property string|null $s3_bucket
 * @property string|null $apn_certificate
 * @property string|null $fcm_certificate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereApnCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereFcmCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereS3Bucket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessApp whereUpdatedAt($value)
 */
	class BusinessApp extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class BusinessIntegration.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $business_id
 * @property string|null $facebook_pixel_id
 * @property string|null $google_analytics_id
 * @property string|null $cloudfront_id
 * @property string|null $s3_bucket_id
 * @property string|null $google_access_token
 * @property string|null $google_refresh_token
 * @property string|null $google_expiration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read bool $calendar_enabled
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereCloudfrontId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereFacebookPixelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereGoogleAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereGoogleAnalyticsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereGoogleExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereGoogleRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereS3BucketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIntegration whereUpdatedAt($value)
 */
	class BusinessIntegration extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class BusinessLocation.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $business_id
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property float $lat
 * @property float $long
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereZip($value)
 */
	class BusinessLocation extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class BusinessProfile.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $business_id
 * @property string|null $image
 * @property string|null $cover
 * @property string|null $short_description
 * @property string|null $long_description
 * @property string|null $primary_color
 * @property string|null $secondary_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile wherePrimaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereSecondaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessProfile whereUpdatedAt($value)
 */
	class BusinessProfile extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Category.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property string $icon_image
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIconImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 */
	class Category extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class ChatMessage.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $chat_room_id
 * @property int $sender_id
 * @property string $text
 * @property bool $read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ChatRoom $room
 * @property-read \App\Models\User $sender
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereChatRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereUpdatedAt($value)
 */
	class ChatMessage extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class ChatRoom.
 *
 * @package namespace App\Models;
 * @property string $id
 * @property int $business_id
 * @property array $users
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read \App\Models\ChatMessage|\Illuminate\Database\Eloquent\Relations\HasMany|object|null $last_message
 * @property-read \App\Models\User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChatMessage[] $messages
 * @property-read int|null $messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereUsers($value)
 */
	class ChatRoom extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Deployment.
 *
 * @package namespace App\Models;
 * @property string $id
 * @property int $business_id
 * @property int $deployment_status_id
 * @property \Illuminate\Support\Carbon|null $start_time
 * @property \Illuminate\Support\Carbon|null $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read int|null $build_time
 * @property-read \App\Models\DeploymentStatus|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereDeploymentStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deployment whereUpdatedAt($value)
 */
	class Deployment extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class DeploymentStatus.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeploymentStatus whereUpdatedAt($value)
 */
	class DeploymentStatus extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class JobIntensity.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|JobIntensity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobIntensity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobIntensity query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobIntensity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobIntensity whereName($value)
 */
	class JobIntensity extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class JobStatus.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereName($value)
 */
	class JobStatus extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class MarketplaceJob.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $business_id
 * @property int $customer_id
 * @property int $category_id
 * @property string $client_name
 * @property float $price
 * @property string $description
 * @property int $status_id
 * @property int $intensity_id
 * @property string $complete_before
 * @property int $views
 * @property string|null $image_one
 * @property string|null $image_two
 * @property string|null $image_three
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Business $business
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $customer
 * @property-read mixed $intensity
 * @property-read mixed $status
 * @property-read \App\Models\JobIntensity|null $jobIntensity
 * @property-read \App\Models\JobStatus|null $jobStatus
 * @property-read \App\Models\MarketplaceLocation|null $location
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\Payout|null $payout
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceProposal[] $proposals
 * @property-read int|null $proposals_count
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob newQuery()
 * @method static \Illuminate\Database\Query\Builder|MarketplaceJob onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereCompleteBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereImageOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereImageThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereImageTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereIntensityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceJob whereViews($value)
 * @method static \Illuminate\Database\Query\Builder|MarketplaceJob withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MarketplaceJob withoutTrashed()
 */
	class MarketplaceJob extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class MarketplaceLocation.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $marketplace_id
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property float $lat
 * @property float $long
 * @property-read array $coordinate
 * @property-read \App\Models\MarketplaceJob $marketplaceJob
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceLocation whereZip($value)
 */
	class MarketplaceLocation extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class MarketplaceProposal.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $marketplace_id
 * @property int $user_id
 * @property int $status_id
 * @property string|null $rating
 * @property string|null $review
 * @property string|null $arrived_at
 * @property string|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status
 * @property-read \App\Models\MarketplaceJob $marketplaceJob
 * @property-read \App\Models\ProposalStatus|null $proposalStatus
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal query()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereArrivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketplaceProposal whereUserId($value)
 */
	class MarketplaceProposal extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * App\Models\PasswordReset
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $token
 * @property int $used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereUserId($value)
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Payment.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $marketplace_id
 * @property int $user_id
 * @property float $amount
 * @property string $stripe_token
 * @property bool $refunded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MarketplaceJob $marketplaceJob
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStripeToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class PaymentMethod.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property string $stripe_customer_id
 * @property string $stripe_card_id
 * @property string $card_type
 * @property string $card_last4
 * @property int $exp_month
 * @property int $exp_year
 * @property bool $default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCardLast4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereStripeCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereStripeCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereUserId($value)
 */
	class PaymentMethod extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Payout.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $marketplace_id
 * @property int $user_id
 * @property float $amount
 * @property string $stripe_token
 * @property bool $reversed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MarketplaceJob $marketplaceJob
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereReversed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereStripeToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUserId($value)
 */
	class Payout extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class PayoutMethod.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property string $stripe_connect_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereStripeConnectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereUserId($value)
 */
	class PayoutMethod extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models\Pivots{
/**
 * App\Models\Pivots\BusinessUser
 *
 * @property int $user_id
 * @property int $business_id
 * @property int $role_id
 * @property string|null $apn_token
 * @property string|null $fcm_token
 * @property bool $email_notifications
 * @property bool $sms_notifications
 * @property bool $push_notifications
 * @property-read \App\Models\Business $business
 * @property-read \App\Models\UserRole $role
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereApnToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereEmailNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser wherePushNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereSmsNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessUser whereUserId($value)
 */
	class BusinessUser extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProposalStatus.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereName($value)
 */
	class ProposalStatus extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string|null $apn_token
 * @property string|null $fcm_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $last_seen_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Business[] $businesses
 * @property-read int|null $businesses_count
 * @property-read mixed $amount
 * @property-read bool $is_active
 * @property-read mixed $last_seen
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|\App\Models\PaymentMethod|null $primary_payment_method
 * @property-read \App\Models\UserLastLocation|null $lastLocation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceJob[] $marketplaceJobs
 * @property-read int|null $marketplace_jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceProposal[] $marketplaceProposals
 * @property-read int|null $marketplace_proposals_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Business[] $ownsBusiness
 * @property-read int|null $owns_business_count
 * @property-read \App\Models\PasswordReset|null $passwordReset
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentMethod[] $paymentMethods
 * @property-read int|null $payment_methods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\PayoutMethod|null $payoutMethod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payout[] $payouts
 * @property-read int|null $payouts_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSavedLocation[] $savedLocations
 * @property-read int|null $saved_locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApnToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * Class UserLastLocation.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property float $lat
 * @property float $long
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLastLocation whereUserId($value)
 */
	class UserLastLocation extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class UserProfile.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property string $image
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class UserRole.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 */
	class UserRole extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class UserSavedLocation.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $user_id
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property float $lat
 * @property float $long
 * @property bool $default
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedLocation whereZip($value)
 */
	class UserSavedLocation extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

