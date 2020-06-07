<?php

namespace App\Http\Requests\All;

use App\Permission as P;
use App\Role as R;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RecordsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->hasRole([R::ADMIN,R::BUSINESS, R::API]) &&
            Auth::user()->hasAnyDirectPermission(P::CAN_CREATE, P::CAN_READ))
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
            'first_name' => 'required|string|max:32',
            'middle_name' => 'nullable|string|max:32',
            'last_name' => 'required|string|max:32',
            'dob' => 'required|string|max:10',
            'ssn' => 'required|string|max:11',
            'tracking' => 'nullable|string',
            'provider_id' => 'required|numeric',
            'business_id' => 'required|numeric',
        ];
    }
}
