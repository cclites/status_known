<?php

namespace App\Http\Requests;

use App\Permission as P;
use App\Role as R;
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
        if(Auth::user()->hasRole([R::ADMIN,R::SYSTEM]) &&
            Auth::user()->hasAnyPermissionTo([P::CAN_UPDATE, P::CAN_DELETE, P::CAN_CREATE, P::CAN_READ]))
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
