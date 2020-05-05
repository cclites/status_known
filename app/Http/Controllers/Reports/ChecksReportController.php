<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Reports\ChecksReport;
use App\Http\Controllers\Controller;

class ChecksReportController extends Controller
{
    public function index(Request $request, ChecksReport $report){

        if ($request->filled('json')) {

            $timezone = '';

            $data = $report->setTimezone($timezone)
                            ->applyFilters(
                                $request->all()
                            )
                            ->rows();

            return response()->json(['data'=>$data]);
        }

        return view_component('checks-report', 'Checks Report', [], []);

    }

}
