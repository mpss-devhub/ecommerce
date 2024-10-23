<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallbackRequest;
use App\Http\Services\PaymentService;
use Illuminate\Http\Request;

class CallBackController extends Controller
{
    protected $PaymentService;

    public function __construct(PaymentService $PaymentService)
    {
        $this->PaymentService = $PaymentService;
    }

    public function directCallback(CallbackRequest $callbackRequest)
    {
        $this->PaymentService->updateDirectPaymentSuccess($callbackRequest);
        return response()->json(['message' => 'success']);
    }

    public function redirectCallback(CallbackRequest $callbackRequest)
    {
        $this->PaymentService->updateRedirectPaymentSuccess($callbackRequest);
        return response()->json(['message' => 'success']);
    }
}
