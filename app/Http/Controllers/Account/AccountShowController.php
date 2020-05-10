<?php

namespace App\Http\Controllers\Account;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model\AccountRequest;
use Illuminate\Http\Request;

class AccountShowController extends Controller
{
    public function show(Account $account, AccountRequest $request){

        return response()->json($account);
    }
}
