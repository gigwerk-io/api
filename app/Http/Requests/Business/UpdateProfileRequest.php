<?php

namespace App\Http\Requests\Business;

use App\Rules\Base64ImageRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['string'],
            'image' => [new Base64ImageRule()],
            'cover' => [new Base64ImageRule()],
            'short_description' => ['string'],
            'long_description' => ['string'],
            'primary_color' => ['string'],
            'secondary_color' => ['string']
        ];
    }
}
