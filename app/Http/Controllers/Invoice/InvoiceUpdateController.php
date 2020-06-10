<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Invoice;
use App\Role as R;
use Illuminate\Support\Facades\Auth;

class InvoiceUpdateController extends Controller
{
    public function update(InvoiceUpdateRequest $request, Invoice $invoice){

        $invoice->update($request->toArray());
        $invoiceQuery = Invoice::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $invoiceQuery->where('business_id', Auth::user()->business_id);
        }elseif(Auth::user()->hasRole([R::ADMIN])){

        }

        $invoices = $invoiceQuery->get();
        return response()->json($invoices);
    }
}
