<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Record;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Response;

class RecordController extends Controller
{
    public function index(){}

    public function download(Record $record){
        /*
        //$snappy = App::make('snappy.pdf');
        $html = '<h1>test</h1><p>test from test</p>';

        //$pdf = PDF::loadView('pdf.invoice', $data);
        $pdf = new PDF('/vendor/h4cc/wkhtmltoimage-amd64/bin');
        $pdf->generateFromHtml($html);

        return $pdf->download('invoice.pdf');
        */

        $html = response(view('print.print_record', [
            'record'=>$record,
        ]))->getContent();
        $snappy = App::make('snappy.pdf');

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="test_record.pdf"'
            )
        );




        //$record->data = json_decode(Crypt::decrypt($record->data));
        //$record->dob = Crypt::decrypt($record->dob);
        //$record->ssn = '***-**-****';

        //$name = $record->last_name . ", " . $record->first_name;

        //$pdf = new PDF('/vendor/h4cc/wkhtmltoimage-amd64/bin');
        //$pdf->loadFromHtml('<h1>test</h1><p>test from test</p>', '/tmp/test-123.pdf');
        //$pdf->download();

        //$pdf = PDF::loadView('print.print_record', ['record' =>$record]);
        //return $pdf->download('record.pdf');
/*
        $html = response(view('print.print_record',['record'=>$record]))->getContent();

        //\Log::info($html);
*/

        //$snappy = \App::make('snappy.pdf');
        /*
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="record.pdf"'
            )
        );
        */

        /*
        $snappy = \App::make('snappy.pdf');
        //$snappy->loadView( 'print.print_record', compact('record') );
        $html = view('print.print_record', compact('record'));

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );*/

    }
}
