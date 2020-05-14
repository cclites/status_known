<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\RecordRequest;
use App\Record;
use Illuminate\Http\Request;

class RecordShowController extends Controller
{
    public function show(Record $record, RecordRequest $request){

        return view('show.record_show', compact('record'));

    }
}
