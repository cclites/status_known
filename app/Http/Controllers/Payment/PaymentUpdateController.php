<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentUpdateRequest;
use Illuminate\Http\Request;

class PaymentUpdateController extends Controller
{
    public function update(PaymentUpdateRequest $request){
        $data = $request->validated();
    }
}
