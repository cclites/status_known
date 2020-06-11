<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;

use App\Account;
use App\Http\Requests\Model\AccountRequest;


class AccountShowController extends BaseController
{
    public function show(Account $account, AccountRequest $request)
    {
        return response()->json($account);
    }
}
