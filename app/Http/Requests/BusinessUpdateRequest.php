<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'responsible_agent_id' => 'required|numeric',
            'address_1' => 'required|string|max:150',
            'address_2' => 'nullable|string|max:150',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:25',
            'zip' => 'required|string|max:12',
            'phone' => 'required|string|max:12',
        ];
    }
}
