<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Reports\BusinessesReport;
use App\Http\Controllers\Controller;

class BusinessesReportController extends Controller
{
    public function index(Request $request, BusinessesReport $report){

        if ($request->filled('json')) {

            $timezone = '';

            $data = $report->setTimezone($timezone)
                            ->applyFilters(
                                $request->all()
                            )
                            ->rows();

            return response()->json(['data'=>$data]);
        }

        return view_component('businesses-report', 'Businesses Report', [], []);

    }

}
