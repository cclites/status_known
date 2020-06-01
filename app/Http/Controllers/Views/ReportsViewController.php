<?php

namespace App\Http\Controllers\Views;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\All\ReportsRequest;

//TODO: Move this stuff into a Base Request
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;
class ReportsViewController extends Controller
{
    //Maybe not called at all?
    public function index(ReportsRequest $request){

        //\Log::info(json_encode($request->all()));

        $reportsQuery = \App\Report::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $reportsQuery->where('business_id', auth()->user()->business_id);
        }

        if (auth()->user()->hasRole(R::ADMIN)){
            $reportsQuery->where('id', $request->user);
        }

        $start = (new Carbon($request->start_date));
        $end = (new Carbon($request->end_date));

        $reports = $reportsQuery
                    ->whereBetween('created_at', [$start, $end])
                    ->orderBy('id')
                    ->with('requested_by', 'record', 'business')
                    ->get()
                    ->map(function($report){

                        return [
                            'business_name' => $report->business->name,
                            'report_id' => $report->id,
                            'requested_by' => $report->requested_by->name,
                            'requested_for' => $report->record->first_name . " " . $report->record->last_name,
                            'request_date' => (new Carbon($report->record->created_at))->format('m-d-Y'),
                            'completion_date' => (new Carbon($report->record->updated_at))->format('m-d-Y'),
                        ];

                    });

        return response()->json($reports);
    }
}
