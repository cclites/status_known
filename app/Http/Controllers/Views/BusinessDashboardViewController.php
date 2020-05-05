<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use App\Role as R;

class BusinessDashboardViewController extends Controller
{
    public function index(Request $request){

        return view_component('business-dashboard-vue', 'BusinessDashboard', [], []);
    }

}
