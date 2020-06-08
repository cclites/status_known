<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model\BusinessRequest;
use Illuminate\Http\Request;

class BusinessShowController extends Controller
{
    public function show(Business $business, BusinessRequest $request){

        $business = $business->load('addresses', 'phone_numbers');

        if($request->json){
            return $business;
        }

        return view('business.settings_business', compact('business'));

    }
}
