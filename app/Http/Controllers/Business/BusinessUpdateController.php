<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\BusinessUpdateRequest;

use App\Business;

class BusinessUpdateController extends BaseController
{
    /**
     * @param BusinessUpdateRequest $request
     * @param Business $business
     */
    public function update(BusinessUpdateRequest $request, Business $business)
    {
        $business->update($request->validated());
        return response()->json($business);
    }
}
