<?php

namespace App\Http\Requests\Marketplace;

use App\Rules\Base64ImageRule;
use Illuminate\Foundation\Http\FormRequest;
use LVR\State\Abbr;

class EditJobRequest extends FormRequest
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
            'description' => [ 'string'],
            'complete_before' => ['date'],
            'intensity_id' => ['exists:job_intensities,id'],
            'price' => ['numeric'],
            'street_address' => [ 'string'],
            'city' => [ 'string'],
            'state' => [ new Abbr('US')],
            'zip' => ['postal_code:US'],
        ];
    }
}
