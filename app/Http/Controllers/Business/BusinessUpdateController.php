<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\BusinessUpdateRequest;
use Illuminate\Http\Request;

class BusinessUpdateController extends Controller
{
    public function update(BusinessUpdateRequest $request){

        $data = $request->validated();

        if($request->business_id){
            $business = \App\Business::find($request->business_id);
            $business->update($data);

        }else{
            $business = \App\Business::make($data);
        }

        return response()->json($business);

    }
}
