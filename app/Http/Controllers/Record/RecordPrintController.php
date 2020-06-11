<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RecordRequest;
use App\Record;

/**
 * Class RecordPrintController
 * @package App\Http\Controllers\Record
 * @function download
 */
class RecordPrintController extends Controller
{
    //This is accessed both via web routes and API routes. A call
    //made from the API won't have a tracking number.
    public function download(RecordRequest $request, Record $record)
    {
        //If coming from API
        if($request->tracking){
            $record = Record::where('tracking', $request->tracking)->first();
        }

        if(!$record && !$request->tracking){
            \Log::error("There is no record.");
            \Log::info(json_request($request));
            \Log::info(json_request($record));
            return abort(400, 'Error locating record.');
        }

        try{
            return $record->print();
        }catch(\Exception $e){
            \Log::info($e->getMessage());
            return abort(500, 'Unable to process record.');
        }
    }
}
