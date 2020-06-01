<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\All\InvoicesRequest;

use Carbon\Carbon;

class InvoicesViewController extends Controller
{
    public function index(InvoicesRequest $request){

        $invoicesQuery = \App\Invoice::query();

        if($request->business && auth()->user()->hasRole(R::ADMIN)){
            $invoicesQuery->where('business_id', $request->business);
        }

        if(auth()->user()->hasRole(R::BUSINESS)){
            $invoicesQuery->where('business_id', auth()->user()->business_id);
        }

        if (auth()->user()->hasRole(R::ADMIN) && $request->business){
            $invoicesQuery->where('business_id', $request->business);
        }

        if($request->start_date){

            $start_date = (new Carbon($request->start_date))->startOfDay();
            $end_date = (new Carbon($request->end_date))->endOfDay();

            $invoicesQuery->whereBetween('created_at', [$start_date, $end_date]);
        }

        $invoices = $invoicesQuery
                    ->with('business', 'records')
                    ->orderBy('id')
                    ->get()
                    ->map(function($invoice){

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
