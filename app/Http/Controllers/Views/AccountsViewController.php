<?php

namespace App\Http\Controllers\Views;

use App\Http\Requests\All\AccountsRequest;
use App\Role as R;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AccountsViewController extends Controller
{
    public function index(AccountsRequest $request){

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
                                          'account_id' => $account->id,
                                          'account_name' => $account->account_name
                                      ];

                                  });

        return response()->json($accounts);
    }

}
