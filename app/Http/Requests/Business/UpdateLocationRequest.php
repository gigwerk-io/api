<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;
use LVR\State\Abbr;

class UpdateLocationRequest extends FormRequest
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
            'street_address' => ['string'],
            'city' => ['string'],
            'state' => [new Abbr('US')],
            'zip' => ['postal_code:US'],
        ];
    }
}
