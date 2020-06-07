<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;

//use Barryvdh\DomPDF\Facade\PDF;
use PDF;

use App\Http\Requests\Api\RecordRequest;


/**
 * Handles downloads for records from API
 *
 * Class RecordPrintController
 * @package App\Http\Controllers\Record
 */
class RecordPrintController extends Controller
{
    public function download(RecordRequest $request, Record $record)
    {

        if($request->tracking){
            \Log::info("Don't have a record");
            $record = Record::where('tracking', $request->tracking)->first();
        }else{
            \Log::info("Record Exists");
        }

        if(!$record){
            \Log::error("There is an error in the record.");
            return;
        }

        $record->load('business');

        $record->data = Crypt::decrypt($record->data);
        $record->ssn = Crypt::decrypt($record->ssn);
        $record->dob = Crypt::decrypt($record->dob);

        $pdf = PDF::loadView('print.print_record', compact('record'));
        return $pdf->download('test_record.pdf');


//        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf-amd64');
//        header('Content-Type: application/pdf');
//        header('Content-Disposition: attachment; filename="file.pdf"');
//        $file = $snappy->getOutput($html);
//
//
//        return "";
        //return $file;

        //$snappy = App::make('snappy.pdf');
        /*
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="test_record.pdf"'
            )
        );*/
    }
}
