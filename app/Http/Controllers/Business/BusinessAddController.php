<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessAddController extends BaseController
{
    public function store(BusinessUpdateRequest $request)
    {
        Business::create($request->validated());

        $businesses = $this->businesses();
        return response()->json($businesses);
    }
}

