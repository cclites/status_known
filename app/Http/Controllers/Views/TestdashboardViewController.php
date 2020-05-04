<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestdashboardController extends Controller
{
    public function index(Request $request){


        return view_component('testdashboard-vue', 'Testdashboard', [], []);

    }

}
