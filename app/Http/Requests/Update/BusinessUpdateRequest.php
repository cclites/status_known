<?php

namespace App\Http\Requests\Update;

use App\Role as R;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BaseFormRequest;

class BusinessUpdateRequest extends BaseFormRequest
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
            'name' => 'required|string|max:100',
            'responsible_agent_id' => 'required|numeric',
            'email' => 'required|string|max:36',
            'business_id' => 'sometimes|numeric'
        ];
    }
}
