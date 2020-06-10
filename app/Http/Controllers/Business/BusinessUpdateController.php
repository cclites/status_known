<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessUpdateController extends Controller
{
    /**
     * @param BusinessUpdateRequest $request
     * @param Business $business
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BusinessUpdateRequest $request, Business $business)
    {
        $business->update($request->toArray())->fresh();
        return response()->json($business);
    }
}
