<?php

namespace App\Http\Controllers\Views;


use App\Http\Requests\All\UsersRequest;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProvidersViewController extends Controller
{
    public function index(UsersRequest $request){

        $userQuery = \App\User::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $userQuery->where('business_id', auth()->user()->business_id);
        }

        $users = $userQuery
            ->orderBy('id')
            ->with('business')
            ->get()->map(function($user){

                return [
                    'business_name' => $user->business['name'],
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => (new Carbon($user->created_at))->format('m-d-Y'),
                    'active' => $user->active ? "Yes" : "No",
                    'user_id' => $user->id
                ];

            });

        return response()->json($users);
    }

}
