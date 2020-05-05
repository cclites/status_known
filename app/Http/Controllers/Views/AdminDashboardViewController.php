<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardViewController extends Controller
{
    public function index(Request $request){

        return view_component('admin-dashboard-vue', 'AdminDashboard', [], []);
    }

}
