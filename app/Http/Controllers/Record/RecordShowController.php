<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\RecordRequest;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RecordShowController extends Controller
{
    public function show(Record $record, RecordRequest $request){

        $record->data = Crypt::decrypt($record->data);
        $record->ssn = "***-**-5556";
        $record->dob = Crypt::decrypt($record->dob);

        return view('show.record_show', compact('record'));
        //return view('print.print_record', compact('record'));

    }
}
