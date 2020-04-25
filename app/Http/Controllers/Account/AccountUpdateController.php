<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class AccountUpdateController extends Controller
{
    public function update(AccountUpdateRequest $request){

        //get validated data from $request and use Create to create a new account
    }
}
