<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;
class ReportsViewController extends Controller
{
    //Maybe not called at all?
    public function index(Request $request){

        $reportsQuery = \App\Report::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $reportsQuery->where('business_id', auth()->user()->business_id);
        }

        $reports = $reportsQuery->orderBy('id')->get()->flatten();

        return response()->json($reports);
    }
}
