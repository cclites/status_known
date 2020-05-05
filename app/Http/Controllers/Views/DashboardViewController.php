<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardViewController extends Controller
{
    public function index(Request $request){

        if(\Auth::user()->hasRole('admin')){
            $role = 'admin';
        }else{
            $role = 'business';
        }

        //return view_component('dashboard-vue', 'Dashboard', [], []);
        return view('views/dashboard_view', ['role'=>$role]);
    }

}

//I need to add roles to my user.
