<?php

namespace App\Http\Controllers\Views;

use App\Role as R;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsViewController extends Controller
{
    public function index(Request $request){

        $accountsQuery = \App\Account::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $accountsQuery->where('business_id', auth()->user()->business_id);
        }

        $accounts = $accountsQuery->orderBy('id')
                                  ->with('business')
                                  ->get()
                                  ->map(function($account){

                                      return [
                                          'business_name' => $account->business->name,
                                          'account_number' => $account->account_number,
                                          'card_number' => $account->card_number,
                                          'created_at' => (new Carbon($account->created_at))->format('m-d-Y'),
                                          'updated_at' => (new Carbon($account->updated_at))->format('m-d-Y'),
                                      ];

                                  });

        return response()->json($accounts);
    }

}
