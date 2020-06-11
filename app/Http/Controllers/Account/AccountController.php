<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;

use App\Http\Requests\Model\AccountRequest;
use App\Account;


class AccountController extends BaseController
{
    public function index(AccountRequest $request)
    {
        $accounts = $this->accounts();
        return response()->json($accounts);
    }
}
