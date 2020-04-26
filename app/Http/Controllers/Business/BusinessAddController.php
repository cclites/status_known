<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessUpdateRequest;
use Illuminate\Http\Request;

class BusinessAddController extends Controller
{
    public function store(BusinessUpdateRequest $request){
        $data = $request->validated();
    }
}
