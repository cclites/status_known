<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\Request;

class InvoiceDeleteController extends Controller
{
    public function destroy(InvoiceUpdateRequest $request){
        $data = $request->validated();
    }
}
