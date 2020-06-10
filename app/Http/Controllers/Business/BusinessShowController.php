<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model\BusinessRequest;


class BusinessShowController extends Controller
{
    public function show(Business $business, BusinessRequest $request){

        $business = $business->load('addresses', 'phone_numbers');

        //For unit testing
        if($request->input('json')){
            return response()->json($business);
        }

        $title = $business->name;

        return view('business.settings_business', compact('business', 'title'));

    }
}
