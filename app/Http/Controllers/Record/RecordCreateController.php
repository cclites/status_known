<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Jobs\RequestRecordJob;
use App\Record;
use Illuminate\Http\Request;

class RecordCreateController extends Controller
{
    /**
     * create a new record request
     *
     * @param RecordRequest $request
     */
    public function create(RecordRequest $request)
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

        $record->save();

        /* TODO:: Add record to job queue */
        RequestRecordJob::dispatch($record);

        /* TODO: Return a success or error message */
        return response()->json($record);
    }

    /**
     * add a record to the job queue
     *
     * @param Record $record
     */
    public function addJobToQueue(Record $record)
    {

    }
}


