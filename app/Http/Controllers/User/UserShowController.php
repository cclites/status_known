<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    public function show(User $user, UserRequest $request){

        return response()->json($user);

    }
}
