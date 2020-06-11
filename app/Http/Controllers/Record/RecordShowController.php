<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\RecordRequest;
use App\Record;

class RecordShowController extends BaseController
{
    //We are showing a printable record here
    public function show(Record $record, RecordRequest $request)
    {
        return response()->json($record);
    }
}
