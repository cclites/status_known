<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\InvoiceUpdateRequest;
use App\Invoice;

class InvoiceAddController extends BaseController
{
    public function store(InvoiceUpdateRequest $request)
    {
        $result = Invoice::create($request->validated());
        $invoices = $this->invoices();
        return response()->json($invoices);
    }
}
