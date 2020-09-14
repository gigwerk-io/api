<?php

namespace App\Models;

use App\Enums\ApplicationEventType;
use App\Enums\ApplicationStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Application.
 *
 * @package namespace App\Models;
 */
class Application extends Model implements Transformable
{
    use TransformableTrait, CastsEnums;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'user_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['average_rating', 'scheduled', 'status_description'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['status' => ApplicationStatus::class];

    /**
     * An application belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An application can have schedule events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(ApplicationEvent::class, 'application_id');
    }

    /**
     * The users average Gigwerk rating.
     *
     * @return mixed
     */
    public function getAverageRatingAttribute()
    {
        return $this->user->marketplaceProposals()->avg('rating');
    }

    public function getStatusDescriptionAttribute()
    {
        return $this->status->description;
    }

    public function getScheduledAttribute()
    {
        switch ($this->status) {
            case ApplicationStatus::NEW():
                return 'Applied on ' . $this->created_at->isoFormat('MMM Do YYYY');
                break;
            case ApplicationStatus::PHONE_SCREENING():
                $event = $this->events()
                    ->where('event_type','=', ApplicationEventType::PHONE_SCREEN())
                    ->first();
                return 'Phone screening on ' . $event->start_time->isoFormat('MMM Do YYYY');
                break;
            case ApplicationStatus::INTERVIEWING():
                $event = $this->events()
                    ->where('event_type','=', ApplicationEventType::INTERVIEW())
                    ->first();
                return 'Interviewing on ' . $event->start_time->isoFormat('MMM Do YYYY');
                break;
            case ApplicationStatus::ONBOARDING():
                $event = $this->events()
                    ->where('event_type','=', ApplicationEventType::ONBOARD())
                    ->first();;
                return 'Onboarding on ' . $event->start_time->isoFormat('MMM Do YYYY');
                break;
            case ApplicationStatus::APPROVED():
                return 'Approved on ' . $this->updated_at->isoFormat('MMM Do YYYY');
                break;
            case ApplicationStatus::REJECTED():
                return 'Rejected on ' . $this->updated_at->isoFormat('MMM Do YYYY');
                break;
        }
    }
}
