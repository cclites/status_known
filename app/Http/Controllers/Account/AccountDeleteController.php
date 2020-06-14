<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\AccountUpdateRequest;
use App\Account;

class AccountDeleteController extends BaseController
{
    public function delete(AccountUpdateRequest $request, Account $account)
    {
        $result = $account->delete();

        $accounts = $this->accounts();
        return response()->json($accounts);
    }

    public function destroy(AccountUpdateRequest $request, Account $account)
    {
        \Log::info("DESTROY ACCOUNT");


        $account->delete();

        $accounts = $this->accounts();
        return response()->json($accounts);
    }
}
