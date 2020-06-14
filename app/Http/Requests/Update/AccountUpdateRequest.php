<?php

namespace App\Http\Requests\Update;

use App\Role as R;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BaseFormRequest;

class AccountUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $method = $this->method();
        $permission = $this->mapRequestMethodToPermission($method);

        if(Auth::user()->hasRole([R::ADMIN,R::BUSINESS]) &&
            Auth::user()->can($permission))
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
        /*
        return [
            'id' => 'sometimes|numeric',
            'business_id' => 'required|numeric',
            'tracking' => 'required|string|max:32',
            'account_number' => 'required|string|max:25',
            'card_number' => 'required|string|max:25',
            'account_name' => 'required|string|max:50',
        ];*/

        return [];
    }
}
