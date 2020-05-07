<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesViewController extends Controller
{
    public function index(Request $request){

        $invoices = \App\Invoice::all()->sortBy('id')->flatten();
        return response()->json($invoices);
    }

}
