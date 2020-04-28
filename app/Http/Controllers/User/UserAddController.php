<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

use App\User;

class UserAddController extends Controller
{
    public function store(Request $request)
    {
        try{
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response(200);
        }catch(\Exception $e){
            \Log::info($e->getMessage());
            return response(500);
        }
    }
}
