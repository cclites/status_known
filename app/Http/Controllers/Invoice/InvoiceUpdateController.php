<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\InvoiceUpdateRequest;
use App\Invoice;

class InvoiceUpdateController extends BaseController
{
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        $invoices = $this->invoices();
        return response()->json($invoices);
    }
}
