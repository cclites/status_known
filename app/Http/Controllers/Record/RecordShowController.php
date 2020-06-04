<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\RecordRequest;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RecordShowController extends Controller
{
    //We are really downloading a record here.
    public function show(Record $record, RecordRequest $request){

        $record = \App\Record::where('tracking', $request->tracking)->first();

        $record->data = Crypt::decrypt($record->data);
        $record->ssn = "***-**-5556";
        $record->dob = Crypt::decrypt($record->dob);

        return view('show.record_show', compact('record'));
    }
}
