<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'created_by_id' => 'required|numeric',
            'provider_id' => 'required|numeric',
            'invoice_id' => 'required|numeric',
            'business_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'data' => 'required',
            'tracking' => 'required|string|max:32',
        ];
    }
}
