<?php

namespace App\Http\Requests\Business;

use App\Enums\ApplicationEventType;
use BenSampo\Enum\Rules\EnumValue;
use DateTimeZone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCalendarEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_type' => ['required', new EnumValue(ApplicationEventType::class, false)],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'notes' => ['string'],
            'timezone' => ['required', 'string', Rule::in(DateTimeZone::listIdentifiers())]
        ];
    }
}
