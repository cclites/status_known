<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\ReportRequest;
use App\Report;
use Illuminate\Http\Request;

class ReportShowController extends Controller
{
    public function show(Report $report, ReportRequest $request){

        if($request->authorize()){

            $record = \App\Record::where('id', $report->id)->with('report')->first();
            return response()->json($record);

        }else{
            return back(401, "You do not have permission to view this resource");
        }

    }
}
