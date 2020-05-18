<?php

namespace App\Http\Requests\Marketplace;

use App\Rules\Base64ImageRule;
use Illuminate\Foundation\Http\FormRequest;
use LVR\State\Abbr;

class SubmitJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string'],
            'complete_before' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'street_address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', new Abbr('US')],
            'zip' => ['required', 'postal_code:US'],
            'business_id' => ['required', 'unique:businesses,unique_id'],
            'price' => ['required', 'numeric']
        ];
    }
}
