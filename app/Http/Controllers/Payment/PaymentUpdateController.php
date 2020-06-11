<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PaymentUpdateRequest;
use App\Payment;


class PaymentUpdateController extends BaseController
{
    public function update(PaymentUpdateRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        $payments = $this->payments();
        return response()->json($payments);
    }
}
