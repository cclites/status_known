<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderUpdateRequest extends FormRequest
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
            'contact_name' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'provider_name' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'email' => 'required|string|max:50',
        ];
    }
}
