<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;

class RecordPrintController extends Controller
{
    public function download(Request $request)
    {

        \Log::info('Download record');

        $record = Record::where('tracking', $request->tracking)->first();

        /*
        //$snappy = App::make('snappy.pdf');
        $html = '<h1>test</h1><p>test from test</p>';

        //$pdf = PDF::loadView('pdf.invoice', $data);
        $pdf = new PDF('/vendor/h4cc/wkhtmltoimage-amd64/bin');
        $pdf->generateFromHtml($html);

        return $pdf->download('invoice.pdf');
        */

        $html = response(view('print.print_record', [
            'record' => $record,
        ]))->getContent();

        \Log::info($html);

        $snappy = App::make('snappy.pdf');

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="test_record.pdf"'
            )
        );


    }
}
