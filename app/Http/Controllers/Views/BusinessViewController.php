<?php

namespace App\Http\Controllers\Views;

use App\Http\Requests\BusinessRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessViewController extends Controller
{
    public function index(BusinessRequest $request){
        $businesses = \App\Business::all()->sortBy('id')->flatten();
        return response()->json($businesses);
    }

}
