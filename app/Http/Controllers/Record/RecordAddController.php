<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\RecordRequest;
use App\Jobs\RequestRecordJob;


use App\Record;


class RecordAddController extends BaseController
{
    /**
     * create a new record request
     *
     * @param RecordsRequest $request
     */
    public function create(RecordsRequest $request)
    {
        //This needs a transformer resource

        $record = Record::create($request->validated());

        $record->dob = Crypt::encrypt($request->dob);
        $record->ssn = $request->ssn ? Crypt::encrypt($request->ssn) : null;
        $record->tracking = Str::random(32);
        $record->data = Crypt::encrypt($record->testRecord());

        /* Add additional record info */
        $record->created_by_id = Auth::user()->id;
        $record->business_id = Auth::user()->business_id;

        if(!$record->update()){
            return response()->json(['message'=>'Unable to dispatch request.', 'status' => 500]);
        }

        RequestRecordJob::dispatch($record);

        return response()->json(['message'=>'Request complete.', 'status' => 200]);

    }


}


