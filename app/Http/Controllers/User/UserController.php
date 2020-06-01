<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all()->sortBy('name');
        return response()->json(users);
    }
}
