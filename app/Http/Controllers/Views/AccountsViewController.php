<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsViewController extends Controller
{
    public function index(Request $request){

        return view_component('accounts-vue', 'Accounts', [], []);
    }

}
