<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessDeleteController extends BaseController
{
    public function delete(BusinessUpdateRequest $request, Business $business)
    {
        $business->delete();

        $businesses = $this->businesses();
        return response()->json($businesses);
    }
}
