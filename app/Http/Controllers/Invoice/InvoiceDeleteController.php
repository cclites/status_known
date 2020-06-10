<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Invoice;
use App\Role as R;
use Illuminate\Support\Facades\Auth;

class InvoiceDeleteController extends Controller
{
    public function delete(InvoiceUpdateRequest $request, Invoice $invoice){

        $invoice->delete();

        $invoiceQuery = Invoice::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $invoiceQuery->where('business_id', Auth::user()->business_id);
        }elseif(Auth::user()->hasRole([R::ADMIN])){

        }

        $invoices = $invoiceQuery->get();
        return response()->json($invoices);
    }
}
