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
            'description' => [ 'string'],
            'complete_before' => [ 'date'],
            'category_id' => [ 'exists:categories,id'],
            'intensity' => ['exists:job_intensities,id'],
            'image_one' => new Base64ImageRule(),
            'image_two' => new Base64ImageRule(),
            'image_three' => new Base64ImageRule(),
            'street_address' => [ 'string'],
            'city' => [ 'string'],
            'state' => [ new Abbr('US')],
            'zip' => ['postal_code:US'],
            'business_id' => [ 'unique:businesses,unique_id']
        ];
    }
}
