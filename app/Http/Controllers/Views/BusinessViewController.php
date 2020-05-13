<?php

namespace App\Http\Controllers\Views;

use App\Http\Requests\All\BusinessesRequest;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessViewController extends Controller
{
    public function index(BusinessesRequest $request){

        $businessesQuery = \App\Business::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $businessesQuery->where('business_id', auth()->user()->business_id);
        }

        $businesses = $businessesQuery->orderBy('id')
            ->with('responsibleAgent')
            ->get()
            ->map(function($business){

                $formattedAddress = $business->address_1 . ", " .
                                    //$business->address_2 ? ($business->address_2 . "<br>") : '' .
                                    $business->city . ", " . $business->state . " " . $business->zip;


                return [
                    'business_name' => $business->name,
                    'responsible_agent' => $business->responsibleAgent->name,
                    'responsible_agent_email' => $business->responsibleAgent->email,
                    'formatted_address' => $formattedAddress,
                    'business_phone' => $business->phone,
                    'business_email' => $business->email,
                    'created_at' => (new Carbon($business->created_at))->format('m-d-Y'),
                    'active' => $business->active ? 'Yes' : 'No',
                    'business_id' => $business->id
                ];
            });

        return response()->json($businesses);

    }

}
