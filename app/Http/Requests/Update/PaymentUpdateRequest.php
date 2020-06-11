<?php

namespace App\Http\Requests\Update;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class PaymentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if(Auth::user()->hasRole([R::ADMIN,R::BUSINESS]) &&
            Auth::user()->hasAnyDirectPermission([P::CAN_UPDATE, P::CAN_DELETE, P::CAN_CREATE, P::CAN_READ]))
        {
            return true;
        }
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
