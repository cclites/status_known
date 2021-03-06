<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecksViewController extends Controller
{
    public function index(Request $request){

        $reportsQuery = \App\Report::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $reportsQuery->where('business_id', auth()->user()->business_id);
        }

        $reports = $reportsQuery->orderBy('id')
                    ->with('requested_by')
                    ->get()->flatten();

        return response()->json($reports);
    }

}
