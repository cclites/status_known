<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\PaymentRequest;
use App\Payment;


class PaymentShowController extends BaseController
{
    public function show(Payment $payment, PaymentRequest $request)
    {
        return response()->json($payment);
    }
}
