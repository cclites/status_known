<?php

namespace App\Http\Requests\Api;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->hasRole([R::API]) &&
            Auth::user()->hasAnyDirectPermission(P::CAN_READ))
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
