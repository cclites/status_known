<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;

use App\Http\Requests\InvoiceUpdateRequest;
use App\Invoice;

class InvoiceAddController extends BaseController
{
    public function create(InvoiceUpdateRequest $request){

        Invoice::create($request->toArray());

        $invoices = $this->invoices();
        return response()->json($invoices);
    }
}
