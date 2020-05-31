<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

use App\Report;

class ReportController extends Controller
{
    public function index(){}

    public function download(Report $report){


    }
}
