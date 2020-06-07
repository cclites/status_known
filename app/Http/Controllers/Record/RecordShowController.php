<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\RecordRequest;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RecordShowController extends Controller
{
    //We are showing a printable record here
    public function show(Record $record, RecordRequest $request){

        $record->load('business');

        $record->dob = Crypt::decrypt($record->dob);
        //TODO: Create a mask for the ssn
        $record->ssn = "***-**-****";
        $record->data = Crypt::decrypt($record->data);

        return view('show.record_show', compact('record'));
    }
}
