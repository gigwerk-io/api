<?php

namespace App\Models;

use App\Enums\ApplicationEventType;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ApplicationEvent.
 *
 * @package namespace App\Models;
 */
class ApplicationEvent extends Model implements Transformable
{
    use TransformableTrait, CastsEnums;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type',
        'application_id',
        'start_time',
        'end_time',
        'completed',
        'notes',
        'google_calendar_id',
        'timezone'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'bool',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'event_type' => ApplicationEventType::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['event_type_description'];

    /**
     * A scheduled event belongs to an application
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    /**
     * Get the description of the event. (E.g. Phone Screening)
     *
     * @return string
     */
    public function getEventTypeDescriptionAttribute()
    {
        return $this->event_type->description;
    }
}
