<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\InvoiceUpdateRequest;
use App\Invoice;


class InvoiceDeleteController extends BaseController
{
    public function delete(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice->delete();

        $invoices = $this->invoices();
        return response()->json($invoices);
    }
}
