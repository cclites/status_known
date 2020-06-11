<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\BusinessRequest;

use App\Business;

class BusinessShowController extends BaseController
{
    public function show(Business $business, BusinessRequest $request)
    {
        $business = $business->load('addresses', 'phone_numbers');
        return response()->json($business);
    }
}
