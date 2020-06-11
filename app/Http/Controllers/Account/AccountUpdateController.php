<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\AccountUpdateRequest;
use App\Account;

class AccountUpdateController extends BaseController
{
    public function update(AccountUpdateRequest $request, Account $account){

        $account->update($request->validated());

        $accounts = $this->accounts();
        return respons()->json($accounts);
    }
}
