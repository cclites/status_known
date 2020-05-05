<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Reports\InvoicesReport;
use App\Http\Controllers\Controller;

class InvoicesReportController extends Controller
{
    public function index(Request $request, InvoicesReport $report){

        if ($request->filled('json')) {

            $timezone = '';

            $data = $report->setTimezone($timezone)
                            ->applyFilters(
                                $request->all()
                            )
                            ->rows();

            return response()->json(['data'=>$data]);
        }

        return view_component('invoices-report', 'Invoices Report', [], []);

    }

}
