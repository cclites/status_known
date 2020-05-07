<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersViewController extends Controller
{
    public function index(Request $request){

        $users = \App\User::all()->sortBy('id')->flatten();
        return response()->json($users);
    }

}
