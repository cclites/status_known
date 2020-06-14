<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\AccountUpdateRequest;
use App\Account;

class AccountAddController extends BaseController
{
    public function store(AccountUpdateRequest $request){

        Account::create($request->validated());

        $accounts = $this->accounts();
        return response()->json($accounts);
    }
}
