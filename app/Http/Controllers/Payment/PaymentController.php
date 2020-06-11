<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\PaymentRequest;
use App\Payment;

class PaymentController extends BaseController
{
    public function index(PaymentRequest $request)
    {
        $payments = $this->payments();
        return response()->json($payments);
    }
}
