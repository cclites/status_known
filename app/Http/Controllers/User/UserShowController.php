<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\UserRequest;
use App\User;

class UserShowController extends BaseController
{
    public function show(User $user, UserRequest $request)
    {
        return response()->json($user);
    }
}
