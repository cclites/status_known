<?php

namespace App\Http\Requests\Update;

use Illuminate\Support\Facades\Auth;

use App\Role as R;
use App\Http\Requests\BaseFormRequest;

class AddressUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $method = $this->method();
        $role = $this->mapRequestMethodToPermission($method);

        if(Auth::user()->hasRole([R::ADMIN,R::BUSINESS]) &&
            Auth::user()->can($role))
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
            'address_1' => 'required|string|max:150',
            'address_2' => 'nullable|string|max:150',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:25',
            'zip' => 'required|string|max:12',
            'type' => 'required|string|'
        ];
    }
}
