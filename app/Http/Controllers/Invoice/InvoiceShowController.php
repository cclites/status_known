<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\InvoiceRequest;
use App\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InvoiceShowController extends Controller
{
    public function show(Invoice $invoice, InvoiceRequest $request){

        //All this is doing is returning the data.
        $invoice = $invoice
                    ->load('records', 'records.created_by', 'business');

        $invoice = [
            'date_completed' => Carbon::parse($invoice->created_at)->format('m/d/Y'),
            'amount' => $invoice->amount,
            'id' => $invoice->id,
            'business_name' => $invoice->business->name,
            'subject_name' => $invoice->records->last_name . ", " . $invoice->records->first_name,
            'by' => $invoice->records->created_by->name,
            'record_date' => Carbon::parse($invoice->records->created_at)->format('m/d/Y'),
        ];

        return view('show.invoice_show', compact('invoice'));
    }
}
