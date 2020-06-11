<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\UserUpdateRequest;
use App\User;

class UserDeleteController extends BaseController
{
    public function destroy(UserUpdateRequest $request, User $user)
    {
        $user->delete();

        $users = $this->users();
        return response()->json($users);
    }
}
