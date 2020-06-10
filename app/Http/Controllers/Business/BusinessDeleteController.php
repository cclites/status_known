<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessDeleteController extends Controller
{
    public function delete(BusinessUpdateRequest $request, Business $business)
    {
        if($business->delete()){
            return response(200);
        }

        return response(500);
    }
}
