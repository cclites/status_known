<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\All\RecordsRequest;
use App\Jobs\RequestRecordJob;
use database\factories\RecordDataFactory;
use \Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\Auth;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Faker\Generator as Faker;


class RecordCreateController extends Controller
{
    /**
     * create a new record request
     *
     * @param RecordsRequest $request
     */
    public function create(RecordsRequest $request)
    {
        $record = new Record();

        /* Record request info */
        $record->first_name = $request->first_name;
        $record->middle_name = $request->middle_name;
        $record->last_name = $request->last_name;
        $record->dob = Crypt::encrypt($request->dob);
        $record->ssn = $request->ssn ? Crypt::encrypt($request->ssn) : null;

        /* Add additional record info */
        $record->created_by_id = Auth::user()->id;
        $record->business_id = Auth::user()->business_id;
        $record->provider_id = $request->provider_id;
        $record->tracking = Str::random(32);
        $record->data = Crypt::encrypt($record->testRecord());


        if(!$record->save()){
            return response()->json(['message'=>'Unable to dispatch request.', 'status' => 500]);
        }

        RequestRecordJob::dispatch($record);

        return response()->json(['message'=>'Request complete.', 'status' => 200]);

    }


}


