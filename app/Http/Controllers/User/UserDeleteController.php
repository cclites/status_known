<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\UserUpdateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDeleteController extends BaseController
{
    public function delete(Request $request, User $user)
    {
        $user->delete();

        $users = $this->users();
        return response()->json($users);
    }
}
