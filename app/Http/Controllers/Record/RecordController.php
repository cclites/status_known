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

    }
}
