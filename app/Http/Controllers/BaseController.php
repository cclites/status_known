<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

/*** ROLES AND PERMISSIONS **/
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permission as P;
use App\Role as R;

/*** MODELS **/
use App\Account;
use App\Address;
use App\Business;
use App\Invoice;
use App\Payment;
use App\PhoneNumber;
use App\Record;
use App\User;

class BaseController extends Controller
{
    public function accounts()
    {
        $accountsQuery = Account::query();

        if( Auth::user()->hasRole([R::BUSINESS]) ){
            $accountsQuery->where('business_id', Auth::user()->business_id);
        }

        $accounts = $accountsQuery->get();
        return response()->json($accounts);
    }

    public function addresses()
    {
        $addressesQuery = Address::query();

        if( Auth::user()->hasRole([R::BUSINESS]) ){
            $addressesQuery->where('business_id', Auth::user()->business_id);
        }

        $addresses = $addressesQuery->get();
        return response()->json($addresses);
    }

    public function users()
    {
        $userQuery = User::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $userQuery->where('business_id', auth()->user()->business_id);
        }

        $users = $userQuery->get();
        return response()->json($users);
    }

    public function phoneNumbers()
    {
        $phoneNumberQuery = PhoneNumber::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $phoneNumberQuery->where('business_id', auth()->user()->business_id);
        }

        $phoneNumbers = $phoneNumberQuery->get();
        return response()->json($phoneNumbers);
    }

    public function businesses()
    {
        $businessQuery = Business::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $businessQuery->where('business_id', auth()->user()->business_id);
        }

        $businesses = $businessQuery->get();
        return response()->json($businesses);
    }

    public function invoices()
    {
        $invoiceQuery = Invoice::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $invoiceQuery->where('business_id', auth()->user()->business_id);
        }

        $invoices = $invoiceQuery->get();
        return response()->json($invoices);
    }

    public function payments()
    {
        $paymentQuery = Payment::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $paymentQuery->where('business_id', auth()->user()->business_id);
        }

        $payments = $paymentQuery->get();
        return response()->json($payments);
    }

    public function providers()
    {
        $providers = Provider::all();
        return response()->json($providers);
    }

    public function records()
    {
        $recordQuery = Record::query();

        if(Auth::user()->hasRole([R::BUSINESS])){
            $recordQuery->where('business_id', auth()->user()->business_id);
        }

        $records = $recordQuery->get();
        return response()->json($records);
    }
}
