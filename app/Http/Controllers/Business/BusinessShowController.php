<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model\BusinessRequest;
use Illuminate\Http\Request;

class BusinessShowController extends Controller
{
    public function show(Business $business, BusinessRequest $request){

        //**********************************************************
        //**********************************************************
        return view('show.business_show', compact('business'));

        /*
        if($request->authorize()){
            return view('show.business_show', compact('business'));
        }else{
            return back(401, "You do not have permission to view this resource");
        }*/
    }
}
