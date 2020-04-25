<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessUpdateRequest;
use Illuminate\Http\Request;

class BusinessAddController extends Controller
{
    public function store(BusinessUpdateRequest $request){
        //get validated data from $request and use Create to create a new business
    }
}
