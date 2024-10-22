<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallbackRequest;
use App\Http\Services\PaymentService;
use Illuminate\Http\Request;

class CallBackController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function directCallback(CallbackRequest $callbackRequest)
    {
        $this->paymentService->updateDirectPaymentSuccess($callbackRequest);
        return response()->json(['message' => 'success']);
    }

    public function redirectCallback(CallbackRequest $callbackRequest)
    {
        $this->paymentService->updateRedirectPaymentSuccess($callbackRequest);
        return response()->json(['message' => 'success']);
    }
}
