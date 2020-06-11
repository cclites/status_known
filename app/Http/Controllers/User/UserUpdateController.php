<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\UserUpdateRequest;
use App\User;

class UserUpdateController extends BaseController
{
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        $users = $this->users();
        return response()->json($users);
    }
}
