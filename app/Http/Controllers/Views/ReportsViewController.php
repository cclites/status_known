<?php

namespace App\Http\Controllers\Views;

use Carbon\Carbon;
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

        $reports = $reportsQuery
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
