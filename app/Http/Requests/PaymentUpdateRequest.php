<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'business_id' => 'required|numeric',
            'invoice_id' => 'required|numeric',
            'tracking' => 'required|string|max:32',
            'approved' => 'boolean',
            'finalized_on' => 'nullable|date'
        ];
    }
}
