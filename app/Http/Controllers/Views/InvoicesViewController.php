<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InvoicesViewController extends Controller
{
    public function index(Request $request){

        $invoicesQuery = \App\Invoice::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $invoicesQuery->where('business_id', auth()->user()->business_id);
        }

        $invoices = $invoicesQuery->orderBy('id')->get()->flatten();

        return response()->json($invoices);
    }

}
