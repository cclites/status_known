<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\AccountUpdateRequest;
use App\Account;

class AccountDeleteController extends BaseController
{
    public function destroy(AccountUpdateRequest $request, Account $account)
    {
        $account->delete();

        $accounts = $this->accounts();
        return response()->json($accounts);
    }
}
