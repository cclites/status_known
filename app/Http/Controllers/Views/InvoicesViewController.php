<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Carbon\Carbon;

class InvoicesViewController extends Controller
{
    public function index(Request $request){

        $invoicesQuery = \App\Invoice::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $invoicesQuery->where('business_id', auth()->user()->business_id);
        }

        $invoices = $invoicesQuery
                    ->with('business', 'records')
                    ->orderBy('id')
                    ->get()
                    ->map(function($invoice){

                        //\Log::info(json_encode($invoice));
                        \Log::info($invoice->records->last_name);

                        return [
                            'business_name' => $invoice->business->name,
                            'record_name' => $invoice->records->last_name . ", " . $invoice->records->first_name,
                            'invoice_id' => $invoice->id,
                            'amount' => $invoice->amount,
                            'created_at' => (new Carbon($invoice->created_at))->format('m-d-Y'),
                        ];


                    });

        return response()->json($invoices);
    }

}
