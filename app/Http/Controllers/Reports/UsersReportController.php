<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Reports\UsersReport;
use App\Http\Controllers\Controller;

class UsersReportController extends Controller
{
    public function index(Request $request, UsersReport $report){

        if ($request->filled('json')) {

            $timezone = '';

            $data = $report->setTimezone($timezone)
                            ->applyFilters(
                                $request->all()
                            )
                            ->rows();

            return response()->json(['data'=>$data]);
        }

        return view_component('users-report', 'Users Report', [], []);

    }

}
