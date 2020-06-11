<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\InvoiceRequest;
use App\Invoice;


class InvoiceShowController extends BaseController
{
    public function show(Invoice $invoice, InvoiceRequest $request){
        return response()->json($invoice);
    }
}
