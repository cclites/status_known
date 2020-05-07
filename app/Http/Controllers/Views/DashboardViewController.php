<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardViewController extends Controller
{
    public function index(Request $request){

        $user = [];

        if(auth()->user()){
            $user = auth()->user()->load('roles', 'permissions');
        }else{
            return redirect('login');
        }

        return view('views/dashboard_view', ['user'=>$user]);
    }
}
