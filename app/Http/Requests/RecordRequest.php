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
        if(\Auth::user()->hasRole([R::ADMIN,R::BUSINESS]) &&
            \Auth::user()->hasAnyPermissionTo([P::CAN_UPDATE, P::CAN_DELETE, P::CAN_CREATE, P::CAN_READ]))
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
            'middle_name' => 'string|max:32',
            'last_name' => 'required|string|max:32',
            'dob' => 'required|string|max:10',
            'ssn' => 'required|string|max:11',
            'tracking' => 'required|string'
        ];
    }
}

/*
 * first_name: '',
                    middle_name: '',
                    last_name: '',
                    dob: '',
                    ssn: '',
 */
