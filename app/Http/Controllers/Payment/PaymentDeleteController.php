<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Update\PaymentUpdateRequest;
use App\Payment;

class PaymentDeleteController extends BaseController
{
    public function destroy(PaymentUpdateRequest $request, Payment $payment)
    {
        $payment->delete();

        $payments = $this->payments();
        return response()->json($payments);
    }
}
