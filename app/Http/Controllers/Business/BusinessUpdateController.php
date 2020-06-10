<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;
use Illuminate\Support\Facades\Response;

class BusinessUpdateController extends Controller
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
