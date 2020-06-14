<?php

namespace App\Http\Requests\Update;

use App\Role as R;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Auth;

class InvoiceUpdateRequest extends BaseFormRequest
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
            'id' => 'sometimes|numeric',
            'business_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'tracking' => 'required|string|max:32',
        ];
    }
}
