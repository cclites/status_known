<?php

namespace App\Http\Requests\Update;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BusinessUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'responsible_agent_id' => 'required|numeric',
            'email' => 'required|string|max:36',
            'business_id' => 'sometimes|numeric'
        ];
    }
}
