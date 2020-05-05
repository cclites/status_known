<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardViewController extends Controller
{
    public function index(Request $request){

        $user = [];
        $user = auth()->user()->load('roles', 'permissions');

        return view('views/dashboard_view', ['user'=>$user]);
    }
}
