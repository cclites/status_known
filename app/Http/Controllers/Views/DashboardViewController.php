<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardViewController extends Controller
{
    public function index(Request $request){

        //return view_component('dashboard-vue', 'Dashboard', [], []);
        return view('views/dashboard_view');
    }

}
