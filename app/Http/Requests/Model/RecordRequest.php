<?php

namespace App\Http\Requests\Model;

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
        if(\Auth::user()->hasRole([R::ADMIN,R::BUSINESS, R::API]) &&
            \Auth::user()->hasAnyDirectPermission(P::CAN_CREATE, P::CAN_READ))
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
            'tracking' => 'nullable|string',
            'api_token' => 'nullable|string',
        ];
    }
}
