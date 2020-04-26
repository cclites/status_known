<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\Request;

class InvoiceAddController extends Controller
{
    public function store(InvoiceUpdateRequest $request){
        $data = $request->validated();
    }
}
