<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\ReportRequest;
use App\Report;
use Illuminate\Http\Request;

class ReportShowController extends Controller
{
    /**
     * Show a single report
     *
     * @param Report $report
     * @param ReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Report $report, ReportRequest $request){

        $report = $report->with('report')->first();
        return view('show.report_show', compact('report'));

        /*
        if($request->authorize()){

            $record = \App\Record::where('id', $report->id)->with('report')->first();
            return view('views.show', compact('record'));

        }else{
            return back(401, "You do not have permission to view this resource");
        }*/

    }
}
