<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use App\Business;

class BusinessDeleteController extends Controller
{
    public function destroy(BusinessUpdateRequest $request, Business $business){

        $business->delete();

        $businesses = Business::all();
        return response()->json($businesses);
    }
}
