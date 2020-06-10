<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessAddController extends Controller
{
    public function store(BusinessUpdateRequest $request)
    {
        $business = Business::create($request->validated());
        return response()->json($business);
    }
}
