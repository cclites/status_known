<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Jobs\RequestRecordJob;
use App\Record;
use Illuminate\Http\Request;

class RecordCreateController extends Controller
{
    /**
     * create a new record request
     *
     * @param ReportRequest $request
     */
    public function create(ReportRequest $request)
    {
        $record = new Record();

        /* Record request info */
        $record->first_name = $request->first_name;
        $record->middle_name = $request->middle_name;
        $record->last_name = $request->last_name;
        $record->dob = $request->dob;
        $record->ssn = $request->ssn;

        /* Add additional record info */
        $record->created_by_id = \Auth::user()->id;
        $record->business_id = \Auth::user()->business_id;
        $record->provider_id = $request->provider_id;
        $record->tracking = \Str::random(16);

        if(!$record->save()){
            return response()->json(['error'=>'Unable to dispatch request.', 500]);
        }

        RequestRecordJob::dispatch($record);
        return response()->json($record, 200);

    }
}


