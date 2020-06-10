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
        $user = User::create($request->validated());
        return response()->json($user);
    }
}
