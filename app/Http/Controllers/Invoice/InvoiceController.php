<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\InvoiceRequest;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{
    public function index(InvoiceRequest $request)
    {
        $invoices = $this->invoices();
        return response()->json($invoices);
    }
}
