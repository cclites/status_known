<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\UserRequest;

class UserController extends BaseController
{
    public function index(UserRequest $request)
    {
        $users = $this->users();
        return response()->json($users);
    }
}
