<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\PaymentRequest;
use App\Payment;
use Illuminate\Http\Request;

class PaymentShowController extends Controller
{
    public function show(Payment $payment, PaymentRequest $request){

        if($request->authorize()){
            return response()->json($payment);
        }else{
            return back(401, "You do not have permission to view this resource");
        }


    }
}
