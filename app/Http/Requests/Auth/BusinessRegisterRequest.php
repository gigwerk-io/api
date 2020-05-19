<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use LVR\State\Abbr;

class BusinessRegisterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'subdomain_prefix' => ['required', 'unique:businesses,subdomain_prefix'],
            'street_address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', new Abbr('US')],
            'zip' => ['required', 'postal_code:US'],
        ];
    }
}
