<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class AccountAddController extends Controller
{
    public function store(AccountUpdateRequest $request){

        //If user()->hasRole('admin'), return true : return false

        $data = $request->validated();

        //get validated data from $request and use Create to create a new account
    }
}
