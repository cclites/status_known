<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\UserUpdateRequest;
use App\User;

class UserAddController extends BaseController
{
    public function store(UserUpdateRequest $request)
    {
        User::create($request->validated());

        $users = $this->users();
        return response()->json($users);
    }
}
