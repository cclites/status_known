<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsViewController extends Controller
{
    public function index(Request $request){

        $accountsQuery = \App\Account::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $accountsQuery->where('business_id', auth()->user()->business_id);
        }

        $accounts = $accountsQuery->orderBy('id')->get()->flatten();

        return response()->json($accounts);
    }

}
