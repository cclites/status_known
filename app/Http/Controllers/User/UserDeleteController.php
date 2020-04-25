<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserDeleteController extends Controller
{
    public function destroy(UserUpdateRequest $request){}
}
