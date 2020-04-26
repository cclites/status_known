<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

use App\User;

class UserAddController extends Controller
{
    public function store(Request $request)
    {

        \Log::info($request);

        //$request->authorize(true);

        //\Log::info("Store the results");

    }
}
