<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request){


        return view_component('dashboard-vue', 'Dashboard', [], []);

    }

}
