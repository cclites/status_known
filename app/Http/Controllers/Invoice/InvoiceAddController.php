<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Invoice;
use App\Role as R;

class InvoiceAddController extends Controller
{
    public function create(InvoiceUpdateRequest $request){

        Invoice::create($request->toArray());

        $invoiceQuery = Invoice::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $invoiceQuery->where('business_id', Auth::user()->business_id);
        }elseif(Auth::user()->hasRole([R::ADMIN])){

        }

        $invoices = $invoiceQuery->get();
        return response()->json($invoices);

    }
}
