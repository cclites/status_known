<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\InvoiceRequest;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceShowController extends Controller
{
    public function show(Invoice $invoice, InvoiceRequest $request){

        if($request->authorize()){
            return response()->json($invoice);
        }else{
            return back(401, "You do not have permission to view this resource");
        }

    }
}
