<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Permission as P;

class BaseFormRequest extends FormRequest
{

    public function mapRequestMethodToPermission($method)
    {
        if($method === 'POST'){
            return P::CAN_CREATE;
        }elseif ($method === 'GET'){
            return P::CAN_READ;
        }elseif($method === 'PATCH'){
            return P::CAN_UPDATE;
        }elseif($method === 'DELETE'){
            return P::CAN_DELETE;
        }

        return '';
    }
}
