<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardViewController extends Controller
{
    //TODO: This should have requests for each of these I think.
    public function index(Request $request){

        return view_component('admin-dashboard-vue', 'AdminDashboard', [], []);
    }

}
