<?php

namespace App\Http\Requests\User;

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
            'image' => new Base64ImageRule(),
            'email' => 'email',
            'first_name' => 'string',
            'last_name' => 'string',
            'phone' => 'string'
        ];
    }
}
