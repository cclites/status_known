<?php

namespace App\Http\Requests\Model;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Http\FormRequest;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;


class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth()->user()->hasRole([R::ADMIN,R::BUSINESS]) &&
            Auth()->user()->hasAnyDirectPermission([P::CAN_READ]));
        {
            //\Log::info("Authorize");

            //\Log::info(auth()->user()->getPermissionNames());

            return filled(auth()->user()->getPermissionNames());

            //return true;
        }

        \Log::info("Do not authorize");
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
            //
        ];
    }
}
